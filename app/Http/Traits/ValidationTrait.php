<?php

namespace App\Http\Traits;

use App\Models\Revision;
use App\ScreenBuilder\ScreenFields;
use App\ScreenBuilder\ScreenSegments;
use Auth;
use Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Notification;


trait ValidationTrait {

    static protected $instance;


    public function __construct() {
        self::$instance = $this;
    }


    public function getReferenceDateAttribute($date)
    {
        if(empty($date)) return "";
        $date = new \Carbon\Carbon($date);
        return $date->format('d/m/Y');
    }

    public function getStartDateAttribute($date)
    {
        if(empty($date)) return "";
        $date = new \Carbon\Carbon($date);
        return $date->format('d/m/Y');
    }

    public function getEndDateAttribute($date)
    {
        if(empty($date)) return "";
        $date = new \Carbon\Carbon($date);
        return $date->format('d/m/Y');
    }

    public function getBirthdayAttribute($date)
    {
        if(empty($date)) return "";
        $date = new \Carbon\Carbon($date);
        return $date->format('d/m/Y');
    }

    public function getDBTable()
    {
        return $this->table;
    }

    /**
     * Validation Trait; we are using this to validate inputs site-wise
     * @param $data
     * @return mixed
     */

    public function validate($data, $segment=null)
    {
        // figure out validation parameters
        $fields = $this->getFields();
        $rules = [];
        foreach($fields as $key=>$field)
        {
            if(isset($field['validation']) && !empty($field['validation']) && array_key_exists($key, $data)) {
                $rules[$key] = $field['validation'];
            }
        }

        // lets check validation rules in database
        $segmentFields = ScreenFields::where("screen_segment_id", $segment->id)->get();
        foreach($segmentFields as $sf) {
            $meta = json_decode($sf->meta);
            $key = $sf->name;
            if(isset($meta->validation) && !empty($meta->validation) && !isset($rules[$key])) {
                $rules[$key] = $meta->validation;
            }
        }

        return Validator::make($data, $rules);
    }

    /**
     * Called before validation, will remove common POST fields
     * and will even
     *
     * @param $data
     * @return mixed
     */

    public function transformFields($data)
    {
        // todo: drop all array fields instead of naming them here
        unset($data['_token'], $data['personal_id'], $data['function'], $data['submit'], $data['revisions'], $data['tags'], $data['contacts']);

        // properly handle empty entries
        foreach($data as $key=>$value) {
            if(empty($value)) $data[$key] = null;
        }

        $fields = $this->getFields();

        foreach($fields as $key=>$field) {
            if($field['type']=="date" && !empty($data[$key])) {
                $data[$key] = Carbon::createFromFormat('d/m/Y', $data[$key]);
            }
        }
        return $data;

    }

    // Default read

    public function read()
    {
        return [
            'data'=>self::where("user_id", Auth::user()->id)->get(),
            'db_table'=>$this->getDBTable(),
            'buttons'=>['edit']
        ];

    }

    // Get single row from the database

    public function get_single()
    {
        $db_table_name = $this->getDBTable();
        $id = Input::get($db_table_name);
        if($id) {

            $obj = self::where("id", $id)->first();

            if(!$obj) {
                // @todo proper redirection
                exit("Missing resource");
            }

            if($obj->user_id != Auth::user()->id) {
                // @todo proper redirection
                exit("Can't touch this");
            }

            return $obj;
        }
        else {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
    }

    // Default create or update

    public function create_or_update($payload=null, $segment=null)
    {

        $dataOriginal = $_POST;
        $db_table_name = $this->getDBTable();

        if(empty($db_table_name)) {
            exit("No table name set");
        }

        if(Input::get($db_table_name)) {
            $wo = self::where("id", Input::get($db_table_name))->firstOrFail();
            if($wo->user_id != Auth::user()->id) {
                exit("");
            }
            $segment->isEditMode = true;
        } else {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            $wo = self::$instance;
        }

        $data = $this->transformFields($dataOriginal);
        //echo '<pre>';print_r($dataOriginal);exit;

        $isValid = $wo->validate($data, $segment);

        if($isValid->passes()){

            if(method_exists($this, "beforeSave")) {
                $this->before_save($data, $dataOriginal);
            }

            $wo->fill($data);
            $wo->user_id = Auth::user()->id;
            $wo->save();

            if(isset($dataOriginal['revisions'])) {
                $revi = new Revision();
                $revi->create_or_update($dataOriginal['revisions'], self::REVISION_TYPE, $wo->id);
            };

            if(method_exists($this, "afterSave")) {
                $this->afterSave($data, $dataOriginal, $wo->id);
            }

            if($segment->isEditMode) {
                Notification::success("Update successful!");
            } else {
                Notification::success("Entry added");
            }
            return true;

        } else {
            return $isValid->messages();
        }

    }

    public function delete()
    {

        if(Input::get('id')) {

            $wo = self::where("id", Input::get('id'))->where('user_id', Auth::user()->id)->firstOrFail();

            if($wo) {
                DB::table($this->getDBTable())->where("id", Input::get('id'))->where('user_id', Auth::user()->id)->delete();
                    // this hangs for some reason
                    // $wo->delete();
                Notification::success("Entry removed");
                return true;
            }

            return true;
        }

        return true;

    }


}