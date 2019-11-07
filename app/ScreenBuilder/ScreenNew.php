<?php

namespace App\ScreenBuilder;

use App\ConfLangInterfaceTexts;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Translate;


class ScreenNew extends Authenticatable
{
	const SCREEN_DRAFT = 0;
	const SCREEN_ACTIVE = 1;
	const SCREEN_DELETED = 2;

//    protected $table = "CONF_SCR_SCREEN"; // DV0001	
    //protected $table = "screen";  // DV0001
	protected $table = "conf_scr_ui_screens";
    public $incrementing = false;

    static $slug = null;
    static $screen = null;
    static $name = "";
    static $breadcrumbs = [];
    static $breadcrumbLevels = 0;
    static $sameParent = [];


    /**
     * SCOPES
     */


    public static function init($slug=null)
    {
		
        self::$slug = ($slug) ? $slug : implode("/", Request::segments());
		
		//$slug = ($slug) ? $slug : implode("/", Request::segments());

        self::$screen = self::where("url_suffix", self::$slug)->first();
		
		//$screen = self::where("slug", self::$slug)->first();
        if(!empty(self::$screen->help_video_url)) {
            parse_str( parse_url( self::$screen->help_video_url, PHP_URL_QUERY ), $my_array_of_vars );
            if(isset($my_array_of_vars['v'])) {
                self::$screen->help_video_url = $my_array_of_vars['v'] . "?enablejsapi=1";
            }
            if(isset($my_array_of_vars['list'])) {
                self::$screen->help_video_url .= "&list=" . $my_array_of_vars['list'] . "&enablejsapi=1";
            }
        };
        if(isset(self::$screen->help_html) && empty(self::$screen->help_html)) {
            self::$screen->help_html = "Please, play video above to get help for this page.";
        }
        if(!self::$screen) return false;
        self::$breadcrumbs = self::getBreadcrumbsNoParam();
	   //$breadcrumbs = self::getBreadcrumbsNoParam();
		
        self::$sameParent = self::sameParentPagesNoParam();
		
	   //$sameParent = self::sameParentPagesNoParam();
    }


    public function scopeActiveAndDrafts($query)
    {
        return $query->whereIn('is_active', [ self::SCREEN_DRAFT, self::SCREEN_ACTIVE ]);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('is_active', [ self::SCREEN_ACTIVE ]);
    }


    /**
     * OTHER
     */

    public function segments()
    {
        return $this->hasMany('App\ScreenBuilder\ScreenSegments');
    }

    public static function getBreadcrumbsNoParam()
    {		
        $breadcrumbs = [  ];
        $currentParent = self::$screen->screen_id;
        do {
            $screen = ScreenNew::active()->where("screen_id", $currentParent)->first();
            if(!$screen) break;
            $breadcrumbs[$screen->url_suffix] = ConfLangInterfaceTexts::get($screen->screen_title);
            $currentParent = $screen->parent_id;
            if(!$currentParent) break;
        } while(1);
        $rev = array_reverse($breadcrumbs);
		
        self::$breadcrumbLevels = sizeof($rev);
		
        return $rev;
    }


    public static function sameParentPagesNoParam()
    {
		
        $pages = [];
        if(self::$breadcrumbLevels<=2) {return $pages;}
        $screens = ScreenNew::active()->where("parent_id", self::$screen->parent)->orderBy('sort', 'asc')->get();
		
        foreach($screens as $screen) {
            $pages[$screen->url_suffix] = ConfLangInterfaceTexts::get($screen->screen_title);
        }
        if(count($pages)>2 && self::$breadcrumbLevels>2)			
			return $pages;
    }


    public function getTemplate()
    {
        return "render-full-screen";
    }

    static public function helpAvailable()
    {
        return (!empty(self::$screen->help_video_url) || !empty(self::$screen->help_html)) ? true : false;
    }


}
