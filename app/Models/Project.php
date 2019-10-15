<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;
use Illuminate\Support\Facades\DB;
use Notification;

class Project extends Model
{

    use ValidationTrait;

    protected $table = "ud_gen_bio_projects"; // DV0001
    //protected $table = "projects";  // DV0001
    protected $guarded = [ "user_id", "id"];
    public $timestamps = false;
    const REVISION_TYPE = Revision::REVISION_PROJECTS;

    public function getFields()
    {
        return
            [
                'work_experience_id'=> [ 'label'=>'company Name', 'validation'=>'required', 'type'=>'select', 'options'=>WorkExperience::where("user_id", Auth::user()->id)->get()->pluck("company_name", "id")  ],
                'customer'=> [ 'label'=>'customer', 'validation'=>'required', 'type'=>'text'  ],
                'project_name'=> [ 'label'=>'project_name', 'validation'=>'required', 'type'=>'text', 'class'=>'test'  ],
                'job_title'=> [ 'label'=>'job_title', 'validation'=>'required', 'type'=>'text'  ],
                'start_date'=> [ 'label'=>'start_date', 'validation'=>'required', 'type'=>'date'  ],
                'end_date'=> [ 'label'=>'end_date', 'validation'=>'required|date|after:start_date', 'type'=>'date'  ],
                 'version_id'=> [ 'label'=>'Versions', 'validation'=>'required', 'type'=>'select', 'options'=>BiographyVersion::where("user_id", Auth::user()->id)->get()->pluck("version", "id")->prepend('Select Version', '')],	
            ];
    }

   public static function getProjectsWithWorkExperience()
    {
        $output = [];
        $output[] = null;
        $projects = self::where("user_id", Auth::user()->id)->get();
		foreach ($projects as $project){
			$key = $project->id;
			if(isset($project->work_experience_id)) $value = $project->customer_name . " / " . $project->project_name;
			$output[$key] = $value;
		}
		 return $output;
	}

    public function workExperience()
    {
        return $this->hasOne('App\Models\WorkExperience', 'id', 'work_experience_id');
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
    
    
     public function delete()
    {		
        if(Input::get('id')) {	
            
            

            $wo = self::where("id", Input::get('id'))->where('user_id', Auth::user()->id)->firstOrFail();
		
            if($wo) {
				
				$reference=References::where('project_id', Input::get('id'))->where('is_active','1')->get()->toArray();
				if(empty($reference))
				{
					DB::table($this->getDBTable())->where("id", Input::get('id'))->where('user_id', Auth::user()->id)->delete();
					Notification::success("Entry removed");
					return true;
				}
				else
				{
				    
					 Notification::error("This project have some refference data.");
				//	
					 //return false;
				}
                    // this hangs for some reason
                    // $wo->delete();
                    	return true;
                
            }

           
        }

        return true;

    }
    
    
    public static function getVersionWiseData($id)
    {
        return self::where('version_id', $id)->get();
    } 

}
