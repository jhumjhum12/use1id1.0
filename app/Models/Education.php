<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class Education extends Model
{

    use ValidationTrait;

    protected $table = "ud_gen_bio_education"; // DV0001
    //protected $table = "education";  // DV0001
    protected $guarded = [ "user_id", "id"];
    public $timestamps = false;
    const REVISION_TYPE = Revision::REVISION_EDUCATION;

    public function getFields()
    {
        return
            [
				'course'=> ['label'=>'course_name', 'validation'=>'required', 'type'=>'text'],
                'institution'=> ['label'=>'institution_name', 'validation'=>'required', 'type'=>'text'],
				'start_date'=> ['label'=>'start_date', 'validation'=>'required', 'type'=>'date'],
                'end_date'=> ['label'=>'end_date', 'validation'=>'required|date|after:start_date', 'type'=>'date'],
                 'version_id'=> [ 'label'=>'Versions', 'validation'=>'required', 'type'=>'select', 'options'=>BiographyVersion::where("user_id", Auth::user()->id)->get()->pluck("version", "id")->prepend('Select Version', '')],	
            ];
    }


    public function revisions()
    {
        return $this->hasMany('App\Models\Revision', 'resource_id', 'id')
            ->where("type", self::REVISION_TYPE )
            ->where("user_id", Auth::user()->id);
    }

    public function read()
    {
        return [
            'data'=>self::where("user_id", Auth::user()->id)->orderBy('start_date', 'asc')->get(),
            'db_table'=>$this->getDBTable(),
            'buttons'=>['edit']
        ];

    }
    
    public static function getVersionWiseData($id)
    {
        return self::where('version_id', $id)->get();
    } 

}
