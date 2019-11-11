<?php

namespace App\ScreenBuilder;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;


class ScreenSegmentsNew extends Authenticatable
{

//    protected $table = "CONF_SCR_SCREEN_SEGMENTS"; // DV0001
    protected $table = "conf_scr_ui_screen_segments";  // DV0001
    public $incrementing = false;
    public $isEditMode = false;


    /**
     * Get available fields for Screen Builder
     * @param bool|false $allData
     * @return array
     */

    public function getSegmentFields($allData=false)
    {
        $class = $this->model;
        $ignoreFields = ["id", "user_id", "created_at", "updated_at", "remember_token"];
        $return = [];

        if(class_exists($class)) {
            $c = new $class();
            $fileds = $c->getFields();

            foreach($fileds as $k=>$v) {
                if($allData) {
                    $v['name'] = $k;
                    $v['custom'] = false;
                    $v['styling'] = "fa fa-database";
                    $return[$k] = $v;
                }
                if(!$allData) $return[$k] = $k;
            }

            if($allData && method_exists($c, "getDBTable")) {
                $columns = Schema::getColumnListing($c->getDBTable());
                foreach($columns as $column) {
                    if(!isset($return[$column]) && !in_array($column, $ignoreFields)) {
                        $return[$column] = new \stdClass();
                        $return[$column]->name = $column;
                        $return[$column]->styling = "fa fa-exclamation-triangle";
                        $return[$column]->custom = true;
                    }
                }
            }
        }

        if($allData) {
            $htmlFields = ScreenFieldsNew::getHTMLFieldDefinition();
            foreach($htmlFields as $k=>$htmlField) {
                $htmlField['custom']=true;
                $return[$k] = $htmlField;
            }
        }

        return $return;

    }


    public function getSegmentActions()
    {
        return [];
    }

    public function init()
    {

        if(!$this->model || !class_exists($this->model))
        {
            return false;
        }

        $class = $this->model;
        $this->model = $class;

        // initiate class
        $c = new $class();
        $this->fields = $c->getFields();
    }

    // todo: delete?

    public static function getClassNameBySegmentId($id)
    {
        $data = self::where("segment_id", $id)->first();
        if(!$data || !$data->model) return false;
        else return $data->model;
    }

    public function getModel() {
        return $this->model;
    }



}
