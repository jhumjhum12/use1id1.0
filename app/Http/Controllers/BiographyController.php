<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//use App\UserConfTab;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Validator;
use App\Models\BiographyVersion;
use App\Models\WorkExperience;
use App\Models\Project;
use App\Models\Education;
use App\Models\Interest;
use App\Models\Qualification;
use App\Models\Language;
use App\Models\SpokenLanguage;
use App\Models\References;
use Session;
use Carbon\Carbon;

class BiographyController extends Controller
{
    public function version(){
		$userId = Auth::user()->id;
		 //$tab=Screen::where('parent_id','57fe20431baa5')->get();
		 
		 
		 // $tab=DB::table('conf_scr_screen')->where('parent','57fe20431baa5')
		 // ->orderBy('sort','ASC')->get();
       
		$versions = BiographyVersion::where('user_id', $userId)		               
						->where('is_active','=','1')
						->orderBy('id','DESC')
						->get();
						
		foreach($versions as $v){
			$workexp = WorkExperience::where('version_id', $v->id)
					->where('user_id', $userId)
					->where('is_active','=','1')
					->count();
			
			$project = Project::where('version_id', $v->id)
					->where('user_id', $userId)
					->where('is_active','=','1')
					->count();
			
			$vlanguage = SpokenLanguage::where('version_id', $v->id)
					->where('user_id', $userId)
					->where('is_active','=','1')
					->count();

			$education = Education::where('version_id', $v->id)
					->where('user_id', $userId)
					->where('is_active','=','1')
					->count();
							

			$interest = Interest::where('version_id', $v->id)
					->where('user_id', $userId)
					->where('is_active','=','1')
					->count();
			
			$qualification = Qualification::where('version_id', $v->id)
					->where('user_id', $userId)
					->where('is_active','=','1')
					->count();	
					
			$Reference = References::where('version_id', $v->id)
					->where('user_id', $userId)
					->where('is_active','=','1')
					->count();			
					
			$v->summary = $workexp + $project + $vlanguage + $education + $interest + $qualification + $Reference;	
			$v->delmsg = 'This version contains:  \n '.$workexp.'  entries in Work Experience  \n '.$project.' entries in Projects  \n '.$vlanguage.' entries in Language  \n '.$education.' entries in Education  \n '.$interest.' entries in Interests \n '.$qualification.' entries in Qualifications \n '.$Reference.' entries in Reference \n \n Are you Sure Want to Delete?';
			 //$v->delmsg =  nl2br($delmsg);
			//die(0);
		}				
         //echo '<pre>';
		 //print_r($versions);exit;
		// echo '</pre>';
        return view('biography/version',compact('versions'));
    }

    public function wordexperience(){
		$userId = Auth::user()->id;
		$tab=UserConfTab::where('is_active','1')
                            ->where('err_page','')
                            ->where('parent_id','21')
                            ->get();
							
        $version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		
		/*$workexp = WorkExperience::where('ud_gen_bio_work_experience.user_id', $userId)
					->select('ud_gen_bio_work_experience.*','ud_gen_bio_versions.version_name')
					->join('ud_gen_bio_versions', 'ud_gen_bio_versions.id', '=', 'ud_gen_bio_work_experience.version_id')
						->where('ud_gen_bio_work_experience.is_active','=','1')
						->orderBy('ud_gen_bio_work_experience.id','DESC')
						->get();*/

			$workexp = WorkExperience::with('ver')->where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')			
						->get();
							
						
						//echo '<pre>';print_r($workexp);exit;
        return view('biography/work',compact('tab','version','workexp'));
    }

    public function project(){
        $userId = Auth::user()->id;
		$tab=UserConfTab::where('is_active','1')
                            ->where('err_page','')
                            ->where('parent_id','21')
                            ->get();
							
        $version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		$workexp = WorkExperience::where('user_id', $userId)->where('is_active','1')->pluck('job_title','id');
		
		$projectlist = Project::with('version_link','work_link')->where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')			
						->get();
						//echo '<pre>';print_r($projectlist);exit;
							
        return view('biography/project',compact('tab','version','workexp','projectlist'));
        
    }

    public function education(){
        $userId = Auth::user()->id;
		$tab=UserConfTab::where('is_active','1')
                            ->where('err_page','')
                            ->where('parent_id','21')
                            ->get();
							
        $version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		
		$educationlist = Education::with('version_link')->where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')			
						->get();
						
        return view('biography/education',compact('tab','version','educationlist'));
    }

    public function language(){
        $userId = Auth::user()->id;
		$tab=UserConfTab::where('is_active','1')
			->where('err_page','')
			->where('parent_id','21')
			->get();
			
		$language=	Language::where('is_active','1')->where('is_active','1')->pluck('language','id');
		
		$version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		
		$languageList = VersionLanguage::with('ver','lng')->where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')
						->get();
		
        return view('biography/language',compact('tab','language','version','languageList'));
    }
	
	public function addRowlanguage(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$rowval = $input['val'];
			
		$language=	Language::where('is_active','1')->pluck('language','id');
		
		$version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		
        return view('biography/addrowlanguage',compact('language','version','rowval'));
	}

    public function interest(){
        $userId = Auth::user()->id;
		$tab=UserConfTab::where('is_active','1')
                            ->where('err_page','')
                            ->where('parent_id','21')
                            ->get();
							
        $version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		
		$interestlist = Interest::with('version_link')->where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')			
						->get();
        return view('biography/interest',compact('tab','version','interestlist'));
        
    }

    public function qualification(){
        $userId = Auth::user()->id;
		$tab=UserConfTab::where('is_active','1')
                            ->where('err_page','')
                            ->where('parent_id','21')
                            ->get();
							
        $version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		
		$qualificationlist = Qualification::with('version_link')->where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')			
						->get();
        return view('biography/qualification',compact('tab','version','qualificationlist'));
        
    }

    public function reference(){
        $userId = Auth::user()->id;
		$tab=UserConfTab::where('is_active','1')
                            ->where('err_page','')
                            ->where('parent_id','21')
                            ->get();
							
        $version = Version::where('user_id', $userId)->where('is_active','1')->pluck('version_name','id');
		
		$referencelist = Reference::with('version_link')->where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')			
						->get();
        return view('biography/reference', compact('referencelist','tab','version'));
    }
	
	public function saveversiondata(){
		$input=$_POST;
		//print_r($input);exit;
		$userId = Auth::user()->id;
		$input['user_id']=$userId;
		$versionName = $input['version'];
		$chk = BiographyVersion::where('user_id',$userId)
				->where('version',$versionName)
			    ->where('is_active',1)
				->first();
		if(empty($chk->id)){		 
			$validation = Validator::make($input, BiographyVersion::$rules, BiographyVersion::$custom_messages);
			if ($validation->passes())
			{  
		
				if (BiographyVersion::create($input)) {
					session()->flash('status', 'Version save Successfully!');
				} else {
					session()->flash('status', 'Please Try Again!');
				}
				
			} else
			{
				session()->flash('status', $validation->getMessageBag());
			}	
		} else {
			session()->flash('status', 'Version Name Already Exist!');
		}
		return redirect('biography');
	}
	
	public function saveworkexperience(){
		$input=$_POST;
			 $userId = Auth::user()->id;
			 $input['user_id']=$userId;
			
			if (WorkExperience::create($input)) {
				session()->flash('status', 'Your Post save Successfully!');
			} else {
				session()->flash('status', 'Please Try Again!');
			}
	
		return redirect('Wordexperience');
	}
	
	public function saveproject(){
		
			$input=$_POST;
			//echo '<pre>';print_r($input);
			$userId = Auth::user()->id;
			$input['user_id']=$userId;
			
			$wordketails=WorkExperience::where('id', $input['work_experience_id'])->where('is_active','1')->get()->toArray();
			
			if(((strtotime($input['start_date']) > strtotime($wordketails[0]['start_date'])) && (strtotime($input['start_date']) < strtotime($wordketails[0]['end_date']))) && ((strtotime($input['end_date']) > strtotime($wordketails[0]['start_date'])) && (strtotime($input['end_date']) < strtotime($wordketails[0]['end_date'])))){
				
			if (Project::create($input)) {
				session()->flash('status', 'Your Post save Successfully!');
			} else {
				session()->flash('status', 'Please Try Again!');
			}
			}
			else{
				session()->flash('status', 'Your project should be within your work experience!');
			}
	
		return redirect('Project');
	}
	
	public function saveeducation(){
		$input=$_POST;
			$userId = Auth::user()->id;
			$input['user_id']=$userId;
			
			if (Education::create($input)) {
				session()->flash('status', 'Your Post save Successfully!');
			} else {
				session()->flash('status', 'Please Try Again!');
			}
	
			return redirect('Education');
	}
	
	public function saveinterest(){
		$input=$_POST;
			$userId = Auth::user()->id;
			$input['user_id']=$userId;
			
			if (Interest::create($input)) {
				session()->flash('status', 'Your Post save Successfully!');
			} else {
				session()->flash('status', 'Please Try Again!');
			}
	
			return redirect('Interest');
	}
	
	public function savequalification(){
		$input=$_POST;
			$userId = Auth::user()->id;
			$input['user_id']=$userId;			
			
			if (Qualification::create($input)) {
				session()->flash('status', 'Your Post save Successfully!');
			} else {
				session()->flash('status', 'Please Try Again!');
			}
	
			return redirect('Qualification');
	}
	
	public function getversiondata(){
		 $input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$version = BiographyVersion::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		$name = $version->version;
		$desc = $version->introduction;	
		
		$response['name'] = $name;
		$response['desc'] = $desc;
		return $response;
	}
	
	public function editversiondata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$versionId = $input['version_id'];
		$versionName = $input['version'];
		$chk = BiographyVersion::where('user_id',$userId)
				->where('id','!=',$versionId)
				->where('version',$versionName)
			    ->where('is_active',1)
				->first();
		if(empty($chk->id)){		 
			$validation = Validator::make($input, BiographyVersion::$rules, BiographyVersion::$custom_messages);
			if ($validation->passes())
			{  
				$version = BiographyVersion::find($versionId);
				$version->update($input);
				session()->flash('status', 'Version Update Successfully!');
			} else
			{
				session()->flash('status', $validation->getMessageBag());
			}	
		} else {
			session()->flash('status', 'Version Name Already Exist!');
		}	
		return redirect('biography');
	}
	
	public function deleteversiondata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$versionId = $input['id'];
		$version = BiographyVersion::where('id', $versionId)
				->where('user_id',$userId)
			    ->where('is_active',1)
				->delete();
				
		$workexp = WorkExperience::where('version_id', $versionId)
				->where('user_id',$userId)
				->where('is_active','=','1')
				->delete();
		
		$project = Project::where('version_id', $versionId)
				->where('user_id',$userId)
				->where('is_active','=','1')
				->delete();
				
		$vlanguage = SpokenLanguage::where('version_id', $versionId)
				->where('user_id',$userId)
				->where('is_active','=','1')
				->delete();		
		

		$education = Education::where('version_id', $versionId)
				->where('user_id',$userId)
				->where('is_active','=','1')
				->delete();
						

		$interest = Interest::where('version_id', $versionId)
				->where('user_id',$userId)
				->where('is_active','=','1')
				->delete();
		
		$qualification = Qualification::where('version_id', $versionId)
				->where('user_id',$userId)
				->where('is_active','=','1')
				->delete();

		$Reference = References::where('version_id', $versionId)
				->where('user_id',$userId)
				->where('is_active','=','1')
				->delete();			
		// session()->flash('status', 'Version Deleted Successfully!');
		 return redirect('biography');
	}
	
	public function copyversiondata(){		
		$input=$_POST;
		$userId = Auth::user()->id;
		$versionId = $input['id'];
		return view('biography/versioncopy',compact('versionId'));
	}
	
	public function getworkdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$workdetails = WorkExperience::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		
		$response['job'] = $workdetails->job_title;
		$response['version'] = $workdetails->version_id ;
		$response['desc'] = $workdetails->description;
		$response['company'] =$workdetails->company_name ;
		$response['startdate'] = $workdetails->start_date ;
		$response['enddate'] = $workdetails->end_date ;	
		return $response;
	}
	
	public function editworkdata(){		
		$userId = Auth::user()->id;
		
		$work = WorkExperience::find($input['work_id']);
		
		if($work->update($input))
		{			
			session()->flash('status', 'WorkDetails Update Successfully!');
		}
		else{
			session()->flash('status', 'Please Try Again!');
		}
		
		return redirect('Wordexperience');
	}
	
	public function deleteworkdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$workId = $input['id'];
		$workexp = WorkExperience::where('id', $workId)
			    ->where('is_active',1)
				->update(array('is_active'=>0,'updated_at'=>Carbon::Now()));
				
	}

	public function postcopyversiondata(){
		$input=$_POST;		
		$userId = Auth::user()->id;
		$versionId = $input['id'];
		$versionName = $input['version'];
		$chk = BiographyVersion::where('user_id',$userId)
				->where('version',$versionName)
			    ->where('is_active',1)
				->first();
		if(empty($chk->id)){
	
			//$validation = Validator::make($input, BiographyVersion::$rules, BiographyVersion::$custom_messages);
			//if ($validation->passes())
			//{  
				$input['user_id']=$userId;
				$cversion = BiographyVersion::create($input);
				$newversionId = $cversion->id;
				
				$workexp = WorkExperience::where('version_id', $versionId)
						->where('user_id',$userId)
						->where('is_active','=','1')
						->get();
				
				if(!empty($workexp)){
					foreach($workexp as $we){
						$wesdate = str_replace('/', '-', $we->start_date);
						$weedate = str_replace('/', '-', $we->end_date);
						
						$winput['version_id'] = $newversionId;
						$winput['user_id'] = $userId;
						$winput['job_title'] = $we->job_title;
						$winput['company_name'] = $we->company_name;
						$winput['start_date'] = date('Y-m-d', strtotime($wesdate));
						$winput['end_date'] = date('Y-m-d', strtotime($weedate));
						$winput['description'] = $we->description;
						$WorkExperience = WorkExperience::insertGetId($winput);
						$wlid = $WorkExperience;
						
						$project = Project::where('version_id', $versionId)
						->where('work_experience_id',$we->id)	
						->where('user_id',$userId)
						->where('is_active','=','1')
						->get();
						if(!empty($project)){					
							foreach($project as $p){
								$psdate = str_replace('/', '-', $p->start_date);
								$pedate = str_replace('/', '-', $p->end_date);
								
								$pinput['version_id'] = $newversionId;
								$pinput['user_id'] = $userId;
								$pinput['work_experience_id'] = $wlid;
								$pinput['customer_name'] = $p->customer_name;
								$pinput['project_name'] = $p->project_name;
								$pinput['job_title'] = $p->job_title;
								$pinput['start_date'] = date('Y-m-d', strtotime($psdate));
								$pinput['end_date'] = date('Y-m-d', strtotime($pedate));
								$pinput['description'] = $p->description;
								$Project = Project::insertGetId($pinput);
								
								
								$reference = References::where('version_id', $versionId)
										->where('project_id',$p->id)
										->where('user_id',$userId)
										->where('is_active','=','1')
										->get();
								if(!empty($reference)){
									foreach($reference as $ref){
										$refdate = str_replace('/', '-', $ref->reference_date);
										
										$reinput['version_id'] = $newversionId;
										$reinput['user_id'] = $userId;
										$reinput['project_id'] = $Project;
										$reinput['person_name'] = $ref->person_name;
										$reinput['job_title'] = $ref->job_title;
										$reinput['job_position'] = $ref->job_position;
										$reinput['reference_date'] = date('Y-m-d', strtotime($refdate));
										$reinput['description'] = $ref->description;
										$Reference = References::insert($reinput);
									}
								}	
							}
						}		
						
						
					}
				}	
				$language = SpokenLanguage::where('version_id', $versionId)
						->where('user_id',$userId)
						->where('is_active','=','1')
						->get();
				
				if(!empty($language)){
					foreach($language as $ln){
						$lninput['version_id'] = $newversionId;
						$lninput['user_id'] = $userId;
						$lninput['language_id'] = $ln->language_id;
						$lninput['listening'] = $ln->listening;
						$lninput['speaking'] = $ln->speaking;
						$lninput['reading'] = $ln->reading;
						$lninput['writing'] = $ln->writing;						
						$VersionLanguage = SpokenLanguage::insert($lninput);
					}
				}	
						
				

				$education = Education::where('version_id', $versionId)
						->where('user_id',$userId)
						->where('is_active','=','1')
						->get();
				if(!empty($education)){
					foreach($education as $e){
						$esdate = str_replace('/', '-', $e->start_date);
						$eedate = str_replace('/', '-', $e->end_date);
						
						$einput['version_id'] = $newversionId;
						$einput['user_id'] = $userId;
						$einput['course_name'] = $e->course_name;
						$einput['institution_name'] = $e->institution_name;
						$einput['start_date'] = date('Y-m-d', strtotime($esdate));
						$einput['end_date'] = date('Y-m-d', strtotime($eedate));
						$einput['description'] = $e->description;
						$Education = Education::insert($einput);
					}
				}				

				$interest = Interest::where('version_id', $versionId)
						->where('user_id',$userId)
						->where('is_active','=','1')
						->get();
						
				if(!empty($interest)){
					foreach($interest as $i){
						$iinput['version_id'] = $newversionId;
						$iinput['user_id'] = $userId;
						$iinput['interest'] = $i->interest;
						$iinput['description'] = $i->description;
						$Interest = Interest::insert($iinput);
					}
				}			

				$qualification = Qualification::where('version_id', $versionId)
						->where('user_id',$userId)
						->where('is_active','=','1')
						->get();	
						
				if(!empty($qualification)){
					foreach($qualification as $q){
						$qinput['version_id'] = $newversionId;
						$qinput['user_id'] = $userId;
						$qinput['qualification'] = $q->qualification;
						$qinput['description'] = $q->description;
						$Qualification = Qualification::insert($qinput);
					}
				}			
				
				
				session()->flash('status', 'Version save Successfully!');
			
		} else {
			session()->flash('status', 'Version Name Already Exist!');
		}
		return redirect('biography');

	}
	
	public function getprojectdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$projectdetails = Project::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		
		$response['customer'] = $projectdetails->customer_name;
		$response['version'] = $projectdetails->version_id ;
		$response['work_exp'] = $projectdetails->work_experience_id ;
		$response['desc'] = $projectdetails->description;
		$response['pname'] =$projectdetails->project_name;
		$response['job'] =$projectdetails->job_title  ;
		$response['startdate'] = $projectdetails->start_date ;
		$response['enddate'] = $projectdetails->end_date ;	
		return $response;
	}
	
	public function editprojectdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		
		$project = Project::find($input['project_id']);
		
		if($project->update($input))
		{			
			session()->flash('status', 'Project Update Successfully!');
		}
		else{
			session()->flash('status', 'Please Try Again!');
		}
		
		return redirect('Project');
	}
	
	public function deleteprojectdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$projectid = $input['id'];
		$project = Project::where('id', $projectid)
			    ->where('is_active',1)
				->update(array('is_active'=>0,'updated_at'=>Carbon::Now()));
				
	}
	
	public function geteducationdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$educationdetails = Education::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		
		
		$response['version'] = $educationdetails->version_id ;
		$response['course'] = $educationdetails->course_name;
		$response['institute'] =$educationdetails->institution_name;
		$response['des'] =$educationdetails->description;		
		$response['startdate'] = $educationdetails->start_date ;
		$response['enddate'] = $educationdetails->end_date ;	
		return $response;
	}
	
	public function editeducationdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		
		$education = Education::find($input['education_id']);
		
		if($education->update($input))
		{			
			session()->flash('status', 'Education details Update Successfully!');
		}
		else{
			session()->flash('status', 'Please Try Again!');
		}
		
		return redirect('Education');
	}
	
	public function deleteeducationdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$edu_tid = $input['id'];
		$education = Education::where('id', $edu_tid)
			    ->where('is_active',1)
				->update(array('is_active'=>0,'updated_at'=>Carbon::Now()));
				
	}
	
	public function getinterestdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$interestdetails = Interest::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		
		
		$response['version'] = $interestdetails->version_id ;
		$response['interest'] = $interestdetails->interest ;
		$response['des'] =$interestdetails->description;		
		return $response;
	}
	
	public function editinterestdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		
		$interest = Interest::find($input['int_id']);
		
		if($interest->update($input))
		{			
			session()->flash('status', 'Interest details Update Successfully!');
		}
		else{
			session()->flash('status', 'Please Try Again!');
		}
		
		return redirect('Interest');
	}
	
	public function deleteinterestdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$intid = $input['id'];
		$interest = Interest::where('id', $intid)
			    ->where('is_active',1)
				->update(array('is_active'=>0,'updated_at'=>Carbon::Now()));
				
	}
	
	public function getqualificationdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$qualificationdetails = Qualification::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		
		
		$response['version'] = $qualificationdetails->version_id ;
		$response['qualification'] = $qualificationdetails->qualification;
		$response['des'] =$qualificationdetails->description;		
		return $response;
	}
	
	public function editqualificationdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		
		$qualification = Qualification::find($input['qua_id']);
		
		if($qualification->update($input))
		{			
			session()->flash('status', 'Qualification details Update Successfully!');
		}
		else{
			session()->flash('status', 'Please Try Again!');
		}
		
		return redirect('Qualification');
	}
	
	public function deletequalificationdata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$quaid = $input['id'];
		$qualification = Qualification::where('id', $quaid)
			    ->where('is_active',1)
				->update(array('is_active'=>0,'updated_at'=>Carbon::Now()));
				
	}
	
	public function savelanguage(){
		$input=$_POST;
		$userId = Auth::user()->id;
		
		for($i=0;$i<count($input['version_id']);$i++){
			$chk = VersionLanguage::where('user_id',$userId)
				->where('version_id',$input['version_id'][$i])
				->where('language_id',$input['language_id'][$i])
			    ->where('is_active',1)
				->first();
			if(empty($chk->id)){	
				$vinput['user_id'] = $userId;
				$vinput['version_id'] = $input['version_id'][$i];
				$vinput['language_id'] = $input['language_id'][$i];
				if(isset($input['listening'][$i])){
					$vinput['listening'] = '1';
				} else {
					$vinput['listening'] = '';
				}
				if(isset($input['speaking'][$i])){
					$vinput['speaking'] = '1';
				} else {
					$vinput['speaking'] = '';
				}
				if(isset($input['writing'][$i])){
					$vinput['writing'] = '1';
				} else {
					$vinput['writing'] = '';
				}
				if(isset($input['reading'][$i])){
					$vinput['reading'] = '1';
				} else {
					$vinput['reading'] = '';
				}
				
				if(!empty($vinput['listening']) || $vinput['speaking'] || $vinput['writing'] || $vinput['reading']){
					$save = VersionLanguage::create($vinput);
					session()->flash('status', 'Language save Successfully!');
				}
			}
		}	
		//exit;
		return redirect('Language');
	}

	public function deletelanguage(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$intid = $input['id'];
		$VersionLanguage = VersionLanguage::where('id', $intid)
			    ->where('is_active',1)
				->update(array('is_active'=>0,'updated_at'=>Carbon::Now()));
				
	}
	
	public function getlanguagedata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$langdetails = VersionLanguage::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		
		$response['version'] = $langdetails->version_id ;
		$response['lang'] = $langdetails->language_id;
		$response['listening'] =$langdetails->listening;
		$response['speaking'] =$langdetails->speaking  ;
		$response['reading'] = $langdetails->reading ;
		$response['writing'] = $langdetails->writing ;	
		return $response;
	}
	
	public function editlanguagedata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		for($i=0;$i<count($input['version_id']);$i++){
			$chk = VersionLanguage::where('user_id',$userId)
				->where('version_id',$input['version_id'][$i])
				->where('language_id',$input['language_id'][$i])
				->where('id','!=',$input['lang_id'])
			    ->where('is_active',1)
				->first();
			if(empty($chk->id)){	
				$vinput['user_id'] = $userId;
				$vinput['version_id'] = $input['version_id'][$i];
				$vinput['language_id'] = $input['language_id'][$i];
				if(isset($input['listening'][$i])){
					$vinput['listening'] = '1';
				} else {
					$vinput['listening'] = '';
				}
				if(isset($input['speaking'][$i])){
					$vinput['speaking'] = '1';
				} else {
					$vinput['speaking'] = '';
				}
				if(isset($input['writing'][$i])){
					$vinput['writing'] = '1';
				} else {
					$vinput['writing'] = '';
				}
				if(isset($input['reading'][$i])){
					$vinput['reading'] = '1';
				} else {
					$vinput['reading'] = '';
				}
				
				if(!empty($vinput['listening']) || $vinput['speaking'] || $vinput['writing'] || $vinput['reading']){
					$VersionLanguage = VersionLanguage::find($input['lang_id']);
					$VersionLanguage->update($vinput);
					session()->flash('status', 'Language Update Successfully!');
				}
			}
		}	
		
		
		return redirect('Language');
	}
	
	public function savereference(){
			$input=$_POST;
			$userId = Auth::user()->id;
			$input['user_id']=$userId;
						
			if (Reference::create($input)) {
				session()->flash('status', 'Your Reference save Successfully!');
			} else {
				session()->flash('status', 'Please Try Again!');
			}
	
		return redirect('Reference');
	}
	
	public function getreferencedata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$id = $input['id'];
		$referencedetails = Reference::where('user_id', $userId)
						->where('id','=',$id)
						->where('is_active','=','1')
						->first();
		
		$response['customer'] = $referencedetails->customer_name;
		$response['version'] = $referencedetails->version_id ;
		$response['desc'] = $referencedetails->description;
		$response['pname'] =$referencedetails->person_name;
		$response['job'] =$referencedetails->job_title  ;
		$response['jobpos'] = $referencedetails->job_position ;
		$response['date'] = $referencedetails->date ;	
		return $response;
	}
	
	public function editreferencedata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		
		$Reference = Reference::find($input['reference_id']);
		
		if($Reference->update($input))
		{			
			session()->flash('status', 'Reference Update Successfully!');
		}
		else{
			session()->flash('status', 'Please Try Again!');
		}
		
		return redirect('Reference');
	}
	
	public function deletereferencedata(){
		$input=$_POST;
		$userId = Auth::user()->id;
		$projectid = $input['id'];
		$project = Reference::where('id', $projectid)
			    ->where('is_active',1)
				->update(array('is_active'=>0,'updated_at'=>Carbon::Now()));
				
	}
	
	
	public function getVersion()
	{
		$userId = Auth::user()->id;		
		$versions = BiographyVersion::where('user_id', $userId)
						->where('is_active','=','1')
						->orderBy('id','DESC')
						->get()->toArray();
				
			$data=[];
				$i=0;			
			foreach($versions as $ver)
			{
				$data[$i]['id']=$ver['id'];
				$data[$i]['name']=$ver['version'];
				$i++;
			}	
						return $data; 
	}
	
	public function getdataversionwise()
	{		
		$table_name=$_POST['selectedtable'];
		$version_id=$_POST['selectedvaersion'];
		$segmentid=$_POST['segmentid'];
		$userId = Auth::user()->id;
		if($version_id!='')
		{
			$data = DB::table($table_name)->select()->where('version_id',$version_id)->where('user_id',$userId)->get();
		}
		else{
			$data = DB::table($table_name)->select()->where('user_id',$userId)->get();
		}
		//return view("biography.filter")->with('data', $data);
		return view('biography/filter',compact('data','table_name','segmentid'));
		
	}
	
	
	public function getversiondetails()
	{
		$userId = Auth::user()->id;
		$versionid=$_POST['selectedvaersion'];
		$versions = BiographyVersion::where('user_id', $userId)
						->Where("id", $versionid)
						->where('is_active','=','1')						
						->first();
						
		
			$workexp = WorkExperience::where('version_id', $versionid)
					->where('is_active','=','1')
					->count();
			
			$project = Project::where('version_id', $versionid)
					->where('is_active','=','1')
					->count();
			
			$vlanguage = SpokenLanguage::where('version_id', $versionid)
					->where('is_active','=','1')
					->count();

			$education = Education::where('version_id', $versionid)
					->where('is_active','=','1')
					->count();
							

			$interest = Interest::where('version_id', $versionid)
					->where('is_active','=','1')
					->count();
			
			$qualification = Qualification::where('version_id', $versionid)
					->where('is_active','=','1')
					->count();	
					
			$Reference = References::where('version_id', $versionid)
					->where('is_active','=','1')
					->count();			
					
			$summary = $workexp + $project + $vlanguage + $education + $interest + $qualification + $Reference;	
			
			return view('biography/versionDetails',compact('versions','summary'));
			
			
		
	}
	
}
