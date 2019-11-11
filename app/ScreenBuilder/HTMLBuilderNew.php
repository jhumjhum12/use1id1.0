<?php

namespace App\ScreenBuilder;

use Form;
use Request;
use Illuminate\Support\Facades\View;
use URL;
use Illuminate\Support\Facades\Auth;


/**
 * Created by PhpStorm.
 * User: srdjan
 * Date: 9/29/16
 * Time: 12:25
 */

class HTMLBuilderNew
{

    /**
     *
     * Render any of internal screens
     * Single screen may contain multiple Screen Segments
     * Take them one by one, extract available ScreenFields
     * and parse HTML
     *
     * @param $slug
     * @return array
     */

    public static function renderScreen($slug) {

        $screen = ScreenNew::where("url_suffix", $slug)->first();
		
        if(!$screen) {
            return [
                'result' => "",
                'error' => "No Such Page"
            ];
        }

        $result = "";
		
        $screenSegments = ScreenSegmentsNew::where("screen_id", $screen->screen_id)->where("is_active", 1)->orderBy('sort', 'asc')->get();		
        $successfullyParsed = 0;	
	
        foreach($screenSegments as $screenSegment) {

            $screenSegment->init();

                $html = HTMLBuilderNew::formBuilder($screenSegment);				
                if(!empty($html)) {
                    $successfullyParsed++;
                }
                $result .=
                    '<div class="' . $screen->class . '" id="' . $screen->identifier . '">'
                    . $html .
                    '</div>';

        }
		
        if($successfullyParsed==0) {
            $result = ScreenFieldsNew::loadBlade('errors.under-construction');
        }
		
		
        return [
            'screen' => $screen,
            'result' => $result,
        ];
    }

    /**
     * Will parse Form-type HTML for individual Screen Segment
     *
     * @param $seg
     * @return string
     */

    public static function formBuilder($seg)
    {

        $output = "";
			
        // pick up pieces
        $screenFields = ScreenFieldsNew::where("segment_id", $seg->segment_id)->orderBy('sort', 'asc')->get();
			
        // no input, no output
        if($screenFields->count() == 0) return "";

        // open form tag with model or without it
        // currently hardcoded
        // todo enable other functions
        if (strpos($seg->action, 'create_or_update') !== false || strpos($seg->action, 'change_password') !== false) {
            $class = new $seg->model;
            $dbName = $class->getDBtable();
            // Request::url()
            $instance = $class->get_single();
            if($instance->id!=0) {
                $seg->isEditMode = true;
            }
            $output .= Form::model($instance, [ "url"=>"#", "files"=>true]);
        } else {
            $output .= Form::open();
            ScreenFieldsNew::logError("No Data Model");
        }
		
        // function that will be called for POST
        $output .= Form::hidden("function", $seg->action);

        foreach($screenFields as $key=>$value) {
            $output .= ScreenFieldsNew::createHTML($seg, $value);
        }
		//echo '<pre>';print_r($output);exit;
        // form is autoclosing after submit-button
        // $output .= Form::close();

        return "<div class='segment screen-wrap " . $seg->class . "' id='" . $seg->identifier . "'><div class='grp'>" . $output . "</div></div>";
    }


}