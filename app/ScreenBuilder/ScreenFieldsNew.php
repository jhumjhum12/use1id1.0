<?php

namespace App\ScreenBuilder;

use App\Models\Revision;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Form;
use URL;
use Input;
use Route;
use App\Label;
use Illuminate\Support\Facades\View;


class ScreenFieldsNew extends Authenticatable
{

//    protected $table = "CONF_SCR_SCREEN_FIELDS"; // DV0001
    protected $table = "conf_scr_ui_screen_fields";  // DV0001

    protected $metaFields = null;

    protected static $defaultInputClasses = 'form-control input-sm';

    public $incrementing = false;

    protected static $errors = [];

    public function __construct(array $attributes = array())
    {
    }

    public static function createHTML(ScreenSegmentsNew $seg, ScreenFieldsNew $value)
    {

        $output = "";
		
        // screen field may have serialized meta fields, let's unpack them
        $value->unpackMeta();
		
        // we have some hardcoded values stored in model definition, they may be useful
        if($seg->model && class_exists($seg->model)) {
            $tempClass = new $seg->model;
            $tempFields = $tempClass->getFields();
        }			
        $label = \App\ConfLangInterfaceTexts::get($value->field);
		
        if(isset($label)) {
            $value->label = $label;
        } else {
            if($value->field_activity != "recordset")
            self::logError("LBL: Missing label (" . $value->field_activity . ") " . $value->field);
        }
		
		//echo $value->field_activity.'--';
        // let's build some HTML
        switch($value->field_activity) {

            // in other cases, create form control what is said on screen builder
            case "text":
            case "textarea":
            case "email":
            case "number":
            case "date":
            case "readonly":
                $output .= ScreenFieldsNew::buildInputField($value);
                break;

            case "password":
            case "encrypted_password":
                $output .= ScreenFieldsNew::buildPasswordField($value);
                break;

            case "select":
                $output .= ScreenFieldsNew::buildSelectField($seg, $value);
                break;

            // good ol' submit button
            case "submit":
             if($seg->isEditMode == '1' && $seg->model != 'App\User')
				{ 
					//$cls = 'btn btn-primary submitcss';
						$cls = 'btn btn-primary';
				} else {
					$cls ="btn btn-primary";
				}
               $field = "<div style='clear:both' class='form-group'><button type='submit' name='submit' class='".$cls."'>" . $value->field . "</button></div></form>";
                $output .= $field;
                break;

            // recordset table
            case "recordset":
                if($seg->isEditMode) break;
                if(isset($tempClass)) {
                    $output .= self::tableBuilder($tempClass, $seg);
                }
                break;

            // html
            case "html":
                $output .= $value->content;
                break;

            case "file":
                $output .= self::buildFileField($value);
                break;

            // hardcoded html
            case "hr":
                $output .= "<hr style='clear:both' />";
                break;

            // custom control
            case "revision":
                $output .= Revision::render($tempClass);
                break;

            // custom control
            case "read-later-tags":
                $output .= \App\Models\Bookmark::render($tempClass);
                break;

            // contacts list
            case "contacts-list":
                $output .= \App\Models\ContactInfo::render($tempClass);
                break;

            // build fully qualified link
            case "link":
                $output .= self::createLink($value);
                break;
				
			case "button":
				if($seg->isEditMode == '1')
				{
					$output .= self::createCancelLink($value);
					break;	
				}	

        }
		
		
        return $output;

    }

    public function getMeta()
    {
        return json_decode($this->meta);
    }

    public static function getHTMLFieldDefinition()
    {
        // if you change key value for submit here, you change addAutoFields in angular screen builder as well
        return
            [
                'HTML::Recordset' => ['name' => '', 'styling' => 'fa fa-table', 'type' => 'recordset'],
                'HTML::Text' =>      ['name' => '', 'styling' => 'fa fa-edit', 'type' => 'text'],
				'HTML::TextArea' =>  ['name' => '', 'styling' => 'fa fa-edit', 'type' => 'textarea'],				
                'HTML::Email' =>     ['name' => '', 'styling' => 'fa fa-edit', 'type' => 'email'],
                'HTML::Password' =>  ['name' => '', 'styling' => 'fa fa-edit', 'type' => 'password'],
                'HTML::Submit' =>    ['name' => '', 'styling' => 'fa fa-edit', 'type' => 'submit'],
                'HTML::Link' =>      ['name' => '', 'styling' => 'fa fa-link', 'type' => 'link'],
                'HTML::HTML' =>      ['name' => '', 'styling' => 'fa fa-code', 'type' => 'html'],
                'HTML::HR' =>        ['name' => '', 'styling' => 'fa fa-ellipsis-h', 'type' => 'hr'],
				'HTML::Cancel' =>    ['name' => '', 'styling' => 'fa fa-edit', 'type' => 'button'],
            ];


    }


    public static function metaFields()
    {
        return [
            // "label", <-- goes as separate db field
            // "name", <-- goes as separate db field
            "content",      // html content
            "js",           // js functions for input fields (not implemented)
            "placeholder",  // is label or placeholder (not implemented)
            "href",         // for links
            "class",        // css classes for input fields
            "validation",   // validation rules for input fields
            "parameter",    // should be protected somehow
        ];
    }

    public function unpackMeta()
    {
        $metaFields = self::metaFields();
        $existingFields = json_decode($this->meta);
        foreach($metaFields as $k)
        {
            $this->$k = isset($existingFields->$k) ? $existingFields->$k : null;
        }
    }

    public static function buildInputField($value)
    {
        $arg = [];
        $arg['class'] = self::$defaultInputClasses;
        $type = $value->field_activity;

        $labelClass = (!empty($value->validation)) ? "label-required" : "";

        if($value->field_activity == "date") {
            $arg['class'] .= " datepicker";
            $type = "text";
        };
        if($value->field_activity=="readonly") {
            $arg['readonly'] = 'readonly';
            $arg['disabled'] = 'disabled';
            $type = "text";
        };
		
        $label = Form::label($value->field, $value->field, ['class'=>$labelClass]);
        $field = Form::$type($value->field, null, $arg);
        return "<div class='form-group'><div class='control-label'>" . $label . "</div>" . $field . "</div>";
    }

    public static function buildPasswordField($value)
    {
        $labelClass = (!empty($value->validation)) ? "label-required" : "";
        $classes = self::$defaultInputClasses;
        if($value->field_activity=="encrypted_password") {
            $classes .= " encrypted_password";
        }
        $label = Form::label($value->field, $value->field, ['class'=>$labelClass]);
        $field = Form::password($value->field, ['class' => $classes ]);
        return "<div class='form-group'><div class='control-label'>" . $label . "</div>" . $field . "</div>";
    }

    public static function buildFileField($field)
    {
        $label = Form::label($field->field, $field->field);
        $field = Form::file($field->field, ['class' => self::$defaultInputClasses ]);
        return "<div class='form-group'><div class='control-label'>" . $label . "</div>" . $field . "</div>";
    }

    public static function buildSelectField($seg, $value)
    {		
        $labelClass = (!empty($value->validation)) ? "label-required" : "";
        $class = $seg->model;
        if($class) {
            $w = new $class();
            $temp = $w->getFields(); 
			
            if(empty($temp)) return self::logErrorAndReturn("Empty getFields");
            if(!isset($temp[$value->field])) return self::logErrorAndReturn("Missing name field "  . $value->field);
            if(!isset($temp[$value->field]['options'])) return self::logErrorAndReturn("Missing options for "  . $value->field);
			$label = Form::label($value->field, $value->field, ['class'=> $labelClass]);
            $field = Form::select($value->field, $temp[$value->field]['options'], null, ['class'=>self::$defaultInputClasses] );
            return "<div class='form-group'><div class='control-label'>" . $label . "</div>" . $field . "</div>";
        }
        return self::logErrorAndReturn("Missing class "  . $class);

    }

    /**
     * Load blade as HTML
     *
     * @param $blade
     * @return string
     */

    static function loadBlade($blade)
    {
        try {
            $view = View::make($blade);
            return $view->render();
        } catch (\Exception  $e) {
            return "";
        }
    }

    /**
     * Create hyperlink with all parameters available
     *
     * @param $value
     * @return string
     */


    static private function createLink($value)
    {
		
		
        if($value->href) {
            $screen = ScreenNew::where("screen_id", $value->href)->firstOrFail();
            $value->href = URL::to($screen->url_suffix);
        } else {
            $value->href = "#";
        }
		//echo '<pre>';print_r($value);exit;
		
		$label = \App\ConfLangInterfaceTexts::get($screen->screen_title);
        return "<a class='fld-link " . $value->class . "' id='fld-link-" . $value->id . "' href='" . $value->href . "'><span>$label</span></a>";
    }

	static private function createCancelLink($value)
    {
        if($value->href) {
            $screen = ScreenNew::where("screen_id", $value->href)->firstOrFail();
            $value->href = URL::to($screen->url_suffix);
        } else {
            $value->href = "#";
        }
        return "<div style='clear:both' class='form-group'><a class='btn btn-primary " . $value->class . "' id='fld-link-" . $value->id . "' href='" . $value->href . "'><span>$value->field</span></a></div>";
    }

    public function meta($field=null)
    {

        if(!isset($this->meta)) return null;

        if(!$this->metaFields) {
            $this->metaFields = json_decode($this->meta);
        }
        return (isset($this->metaFields->$field)) ? $this->metaFields->$field : false;
    }

    public static function tableBuilder($classInstance, $seg)
    {
        if (method_exists($classInstance, "getRecordset")) {
            $rows = $classInstance->getRecordset();
			
        } else if (method_exists($classInstance, "read")) {
            $rows = $classInstance->read();
			//echo '<pre>';print_r($rows);
        } else return "";

        if(!isset($rows['data'])) { return ""; }

        $tableRoute = 'html-controls.table-builder';

        // check for custom table view
        $customRoute = $tableRoute . "." . $classInstance->getDBtable();
        if(View::exists($customRoute)) {
            $tableRoute = $customRoute;
        }

        $view = View::make($tableRoute, [
            'db_table' => $classInstance->getDBtable(),
            'seg' => $seg,
            'data' => $rows['data'],
            'buttons' => $rows['buttons']
            ]
        );

			
        return $view->render();
    }


    public static function logError($e)
    {
        self::$errors[] = $e;
    }

    public static function logErrorAndReturn($e)
    {
        self::$errors[] = $e;
        return "";
    }

    public static function getErrors()
    {
        return self::$errors;
    }


}
