<?php

namespace App\ScreenBuilder;

use App\Label;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Translate;

class Screen extends Authenticatable
{
	const SCREEN_DRAFT = 0;
	const SCREEN_ACTIVE = 1;
	const SCREEN_DELETED = 2;

//    protected $table = "CONF_SCR_SCREEN"; // DV0001	
    protected $table = "screen";  // DV0001
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

        self::$screen = self::where("slug", self::$slug)->first();
		
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
		//print_r($breadcrumbs);exit;
        self::$sameParent = self::sameParentPagesNoParam();
		
	   //$sameParent = self::sameParentPagesNoParam();
    }


    public function scopeActiveAndDrafts($query)
    {
        return $query->whereIn('status', [ self::SCREEN_DRAFT, self::SCREEN_ACTIVE ]);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', [ self::SCREEN_ACTIVE ]);
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
        $currentParent = self::$screen->id;
        do {
            $screen = Screen::active()->where("id", $currentParent)->first();
            if(!$screen) break;
            $breadcrumbs[$screen->slug] = Label::get($screen->label);
            $currentParent = $screen->parent;
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
        $screens = Screen::active()->where("parent", self::$screen->parent)->orderBy('sort', 'asc')->get();
		
        foreach($screens as $screen) {
            $pages[$screen->slug] = Label::get($screen->label);
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
