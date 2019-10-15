<?php

namespace App\Models;


use Auth;
use Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;

class Revision extends Model
{

//     protected $table = "UD_GEN_BIO_VERSIONS"; // DV0001
    protected $table = "revisions";  // DV0001

    const REVISION_WORK_XP = 1;
    const REVISION_PROJECTS = 2;
    const REVISION_EDUCATION = 3;
    const REVISION_INTERESTS = 4;
    const REVISION_QUALIFICATIONS = 5;
    const REVISION_REFERENCES = 6;
     const REVISION_LANGUAGES = 8;
	
    const REVISION_FIELDS_COUNT = 5;

    protected $guarded = [ "id", "user_id"];

    public $timestamps = false;

    public $hideModel = true;

    public function getDBTable()
    {
        return $this->table;
    }

    public function create_or_update($revisions, $type, $resource_id)
    {
        if(is_array($revisions)) {

            self::drop_revision($type, $resource_id);
			// echo '<pre>';
			// print_r($revisions);
			// echo '</pre>';
			// die(0);
            $i = 0;
            foreach ($revisions as $revision) {

                $i++;

                if(!empty($revision)) {
                    $r = new Revision();
                    $arr =
                        [
                            'type' => $type,
                            'resource_id' => $resource_id,
                            'name' => $i,
                            'text' => $revision
                        ];
                    $r->fill($arr);
                    $r->user_id = Auth::user()->id;
                    $r->save();
                }

            }
        };
    }

    public static function drop_revision($type, $resource_id) {
//        DB::table("UD_GEN_BIO_VERSIONS")  // DV0001      
        DB::table("revisions")  // DV0001
            ->where("resource_id", $resource_id)
            ->where("user_id", Auth::user()->id)
            ->where("type", $type)
            ->delete();
    }

    public static function get_revisions($type, $resource_param_name) {
        $input = Input::get($resource_param_name);
        if($input) {
            return self::where("type", $type)->where("resource_id", $input)->get();
        }
    }

    public static function render($class)
    {
        $revisionType = $class::REVISION_TYPE;
        $records = Revision::get_revisions($revisionType, $class->getDBtable());
        if($records) $records->toArray(); else $records = [];
        $temp = [];
        foreach($records as $record) {
            $temp[$record['name']] = $record['text'];
        }

        $data = [];
        for($i=1; $i<=Revision::REVISION_FIELDS_COUNT; $i++)
        {
            if(isset($temp[$i])) $data[$i] = $temp[$i];
            else $data[$i] = null;
        }

        $view = View::make('html-controls.revision-builder', [
            'data' => $data,
        ]);
        return $view->render();
    }

}
