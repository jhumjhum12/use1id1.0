<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class References extends Model {

    use ValidationTrait;

    protected $table = "ud_gen_bio_references"; // DV0001
    //protected $table = "references"; // DV0001
	protected $guarded = [ "user_id", "id"];
	public $timestamps = false;
	const REVISION_TYPE = Revision::REVISION_REFERENCES;

	public function getFields(){
			return [
				'project_id' => ['label' => 'customer_name', 'validation' => 'required', 'type' => 'select', 'options'=>Project::getProjectsWithWorkExperience() ],
				'person' => ['label' => 'person', 'validation' => 'required', 'type' => 'text'],
				'job_title' => ['label' => 'job_title', 'validation' => 'required', 'type' => 'text'],
				'reference_date' => ['label' => 'reference_date', 'validation' => '', 'type' => 'date'],
				'position_vs_you' => ['label' => 'position_vs_you', 'validation' => 'required', 'type' => 'text'],
				 'version_id'=> [ 'label'=>'Versions', 'validation'=>'required', 'type'=>'select', 'options'=>BiographyVersion::where("user_id", Auth::user()->id)->orWhere("user_id", '0')->get()->pluck("version", "id")->prepend('Select Version', '')],	
			];
		}


	/*
     * Relations
     */


	public function project()
	{
		return $this->hasOne('App\Models\Project', 'id', 'project_id');
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
			'data'=>self::where("user_id", Auth::user()->id)->orderBy('created_at', 'asc')->get(),
			'db_table'=>$this->getDBTable(),
			'buttons'=>['edit']
		];

	}
	
	
	public static function getVersionWiseData($id)
    {
        return self::where('version_id', $id)->get();
    } 


}