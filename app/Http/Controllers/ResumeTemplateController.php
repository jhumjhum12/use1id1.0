<?php

namespace App\Http\Controllers;
use DB;
use Notification;
use Illuminate\Http\Request;
use App\User;
use App\Models\ResumeTemplate;
use App\Http\Requests;
use App\Models\BiographyVersion;
use App\Models\WorkExperience;
use App\Models\Project;
use App\Models\Education;
use App\Models\References;
use App\Models\SpokenLanguage;
use App\Models\Interest;
use App\Models\UserCvTemplate;
use App\Models\Qualification;
use App\LanguagesList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class ResumeTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
	{
		if($request->version)
			{
				$version=$request->version;
			}
			else{
				$version=0;
			}
        if (!empty($request->file('template'))) {
            $user = Auth::user();
			$path = $request->file('template')->store('templates/'.$user->id);
			
            $new = new ResumeTemplate();
    		$new->name = $request->file('template')->getClientOriginalName();
    		$new->user_id = $user->id; 
    		$new->version_id =$version;  
    		$new->path = $path;
    		$new->save();
        }

		return redirect()->back();
	}


    public function showResumeGenerator() {
		$user = Auth::user();		
		$defaulttemplate=DB::table('conf_cv_templates')->get();	
		//////////fetch version fpr login user//////////
		
		$versions = BiographyVersion::where('user_id', $user->id)
		                ->orWhere("user_id", '0')
						->where('is_active','=','1')
						->orderBy('id','DESC')
						->get();
						
						
		$tmp = $user->getFields();
        $fields = [
			'user' => []
		];
		$fields['user'][] = [
                    'key' => 'email',
                    'alias' => "[1ID.email]",
                    'value' => null
                ];
		$phones = $user->phones;
		$i = 1;
		foreach ($phones as $ph) {
			$fields['user'][] = [
                    'key' => 'phone'.$i,
                    'alias' => "[1ID.phone$i]",
                    'value' => null
                ];
			$i++;
		}
		//echo '<pre>';var_dump($phones);exit();
        $allowed = ['text', 'date', 'email', 'number', 'select'];
        foreach ($tmp as $k => $v) {
            if (in_array($v['type'], $allowed) && $k != 'selected_lang') {
                $fields['user'][] = [
                    'key' => $k,
                    'alias' => "[1ID.$k]",
                    'value' => null
                ];
            }
        }
		
		$fields['experience'] = [
			'exp.company' => [
				'alias' => '[exp.company;block=tbs:row]', 
				'alias2' => '[exp.company;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'exp.role' => [
				'alias' => '[exp.role;block=tbs:row]', 
				'alias2' => '[exp.role;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'exp.from_date' => [
				'alias' => '[exp.from_date;block=tbs:row]',
				'alias2' => '[exp.from_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'exp.to_date' => [
				'alias' => '[exp.to_date;block=tbs:row]', 
				'alias2' => '[exp.to_date;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'exp.revision1' => ['alias' => '[exp.revision]', 'value' => []]
		];
		
		
		$fields['projects'] = [
			'proj.company' => [
				'alias' => '[proj.company;block=tbs:row]',
				'alias2' => '[proj.company;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.customer' => [
				'alias' => '[proj.customer;block=tbs:row]',
				'alias2' => '[proj.customer;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.project_name' => [
				'alias' => '[proj.project_name;block=tbs:row]',
				'alias2' => '[proj.project_name;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.job_title' => [
				'alias' => '[proj.job_title;block=tbs:row]',
				'alias2' => '[proj.job_title;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.from_date' => [
				'alias' => '[proj.from_date;block=tbs:row]',
				'alias2' => '[proj.from_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.to_date' => [
				'alias' => '[proj.to_date;block=tbs:row]',
				'alias2' => '[proj.to_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.revision1' => ['alias' => '[proj.revision]', 'value' => []]
		];
		$fields['education'] = [
			'edu.course' => [
				'alias' => '[edu.course;block=tbs:row]',
				'alias2' => '[edu.course;block=tbs:row+tbs:row]',
				'value' => []
			],
			'edu.institution' => [
				'alias' => '[edu.institution;block=tbs:row]', 
				'alias2' => '[edu.institution;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'edu.from_date' => [
				'alias' => '[edu.from_date;block=tbs:row]',
				'alias2' => '[edu.from_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'edu.to_date' => [
				'alias' => '[edu.to_date;block=tbs:row]', 
				'alias2' => '[edu.to_date;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'edu.revision1' => ['alias' => '[edu.revision]', 'value' => []]
		];
		$fields['references'] = [
			'ref.customer' => [
				'alias' => '[ref.customer;block=tbs:row]', 
				'alias2' => '[ref.customer;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'ref.person' => [
				'alias' => '[ref.person;block=tbs:row]',
				'alias2' => '[ref.person;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.job_title' => [
				'alias' => '[ref.job_title;block=tbs:row]',
				'alias2' => '[ref.job_title;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.date' => [
				'alias' => '[ref.date;block=tbs:row]',
				'alias2' => '[ref.date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.position' => [
				'alias' => '[ref.position;block=tbs:row]',
				'alias2' => '[ref.position;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.revision1' => ['alias' => '[ref.revision]', 'value' => []]
		];
		$fields['language'] = [
			'lng.language' => [
				'alias' => '[lng.language;block=tbs:row]',
				'alias2' => '[lng.language;block=tbs:row+tbs:row]',
				'value' => []
			],
			'lng.listening' => ['alias' => '[lng.listening;block=tbs:row]', 'value' => []],
			'lng.speaking' => ['alias' => '[lng.speaking;block=tbs:row]', 'value' => []],
			'lng.reading' => ['alias' => '[lng.reading;block=tbs:row]', 'value' => []],
			'lng.writing' => ['alias' => '[lng.writing;block=tbs:row]', 'value' => []]
		];
		
		$fields['interests'] = [
			'int.name' => [
				'alias' => '[int.name;block=tbs:row]',
				'alias2' => '[int.name;block=tbs:row+tbs:row]',
				'value' => []
			],
			'int.revision1' => ['alias' => '[int.revision]', 'value' => []]
		];
		
		$fields['qualifications'] = [
			'qua.name' => [
				'alias' => '[qua.name;block=tbs:row]',
				'alias2' => '[qua.name;block=tbs:row+tbs:row]',
				'value' => []
			],
			'qua.revision1' => ['alias' => '[qua.revision]', 'value' => []]
		];
		
        $tmpl = $user->resumeTemplates;
        $templates = [];
        foreach ($tmpl as $t) {
            $templates[$t->id] = $t->name;
        }

		return view('member.resume-generator.view', [
			'user' => $user,
			'versions'=>$versions,
            'templates' => $templates,
			'fields' => $fields,
			'defaulttemplate'=>$defaulttemplate
		]);
	}

	public function downloadResume ($templateID,$versionId)
	{
		$user = Auth::user();
		$input = Input::all();
		$revision = empty($input['revision']) ? 1: (int) $input['revision'];
		
		$templateName = $fullPath = $publicPath = '';
		
		if ($templateID === 'example' ) {
			$templateName = 'Example_Template.docx';
			$fullPath = storage_path() . '/Example_Template.docx';
			$publicPath = storage_path() . '/app/public/Example_Template.docx';
			//$versionId = BiographyVersion::getVersionId($user->id);
			
		} elseif ($templateID === 'example2' ) {
			$templateName = 'Example_Two_Rows.docx';
			$fullPath = storage_path() . '/Example_Two_Rows.docx';
			$publicPath = storage_path() . '/app/public/Example_Two_Rows.docx';
			//$versionId = BiographyVersion::getVersionId($user->id);
		} else {
			$template = $user->resumeTemplates->find($templateID);
			$templateName = $template->name;
			//$versionId = $template->version_id;
			$fullPath = storage_path() . '/app/' . $template->path;
			$publicPath = storage_path() . '/app/public/'.$user->id.'/';
			if (!file_exists($publicPath)) {
				mkdir($publicPath, 0777, true);
			}
			$publicPath .= $templateName;
		}
		
		if(!empty($versionId)){ $versionId = $versionId; } else { $versionId = '0'; }
		
		$userData = $refData = $expData = $projData = $eduData = $lngData = $intData = $quaData = [];
		
		$tmp = $user->getFields();
        $allowed = ['text', 'date', 'email', 'number', 'file', 'select'];
        foreach ($tmp as $k => $v) {
            if (in_array($v['type'], $allowed) && $k != 'selected_lang') {
				$userData[0][$k] = isset($user->$k) ? $user->$k : '';
            }
        }
		
		$userData[0]['email'] = $user->email;
		$phones = $user->phones;
		$i = 1;
		foreach ($phones as $ph) {
			$userData[0]['phone'.$i] = $ph->content;
			$i++;
		}
		
		if (!empty($userData[0]['avatar'])) {
			$userData[0]['avatar'] = public_path('profiles') . '/' . $userData[0]['avatar'];
		}
		
		// additional user data (select fields)
		$country = $user->country()
				//->where('lang', strtoupper(\App::getLocale()))
				->first();
		$countryOfBirth = $user->countryOfBirth()
				//->where('lang', strtoupper(\App::getLocale()))
				->first();
			
		
		$userData[0]['blood_type'] = $user->getBloodType();
		$userData[0]['country'] = empty($country) ? '' : $country->toArray()['country'];
		$userData[0]['country_of_birth'] = empty($countryOfBirth) ? '' : $countryOfBirth->toArray()['country'];
		
		$exp = WorkExperience::getVersionWiseData($versionId);
		// echo '<pre>';
		// print_r($exp);
		// echo '</pre>';
		// die();
		foreach ($exp as $e) {
			$element = [
				'company' => $e['company_name'],
				'role' => $e['job_title'],
				'from_date' => empty($e['start_date']) ? '?' : $e['start_date'],
				'to_date' => empty($e['end_date']) ? '?' : $e['end_date'],
				'revision' => $e['description']
			];
			$exists = true;
			/*if (count($e->revisions)) {
				$i = 1;
				foreach ($e->revisions as $rev) {
					if ($rev->name == (string) $revision) {
						$element["revision"] = $rev->text;
						$exists = true;
					}					
					$i++;
				}				
			}*/
			if ($exists) {
				$expData[] = $element;
			}
			
		}
		
		$proj = Project::getVersionWiseData($versionId);
		foreach ($proj as $p) {
			if(!empty($p->work_experience_id))
				{
					$company=WorkExperience::find($p->work_experience_id);
					$companyname=$company->company_name;
				}
				else{
					$companyname='';
				}
			$project = [
				'company' => $companyname,
				'customer' => $p->customer_name,
				'project_name' => $p->project_name,
				'job_title' => $p->job_title,
				'from_date' => $p->start_date,
				'to_date' => $p->end_date,
				'revision' => $p->description
			];
			$exists = true;
			// if (count($p->revisions)) {
				// $i = 1;
				// foreach ($p->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $project["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }				
			// }
			if ($exists) {
				$projData[] = $project;
			}
			
		}
		
		$edu = Education::getVersionWiseData($versionId);
		foreach ($edu as $e) {
			$education = [
				'course' => $e->course_name,
				'institution' => $e->institution_name,
				'from_date' => $e->start_date,
				'to_date' => $e->end_date,
				'revision' => $e->description
			];
			$exists = true;
			// if (count($e->revisions)) {
				// $i = 1;
				// foreach ($e->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $education["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }				
			// }
			if ($exists) {
				$eduData[] = $education;
			}
			
		}
		
		$ref = References::getVersionWiseData($versionId);
		foreach ($ref as $r) {
			if(!empty($r->project_id ))
				{
					$project=Project::find($r->project_id);
					$projectname=$project->project_name;
				}
				else{
					$projectname='';
				}
			$reference = [
				'customer' => $projectname,
				'person' => $r->person_name,
				'job_title' => $r->job_title,
				'date' => $r->reference_date,
				'position' => $r->job_position,
				'revision' => $r->description
			];
			$exists = true;
			// if (count($r->revisions)) {
				// $i = 1;
				// foreach ($r->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $reference["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }
				
			// }
			if ($exists) {
				$refData[] = $reference;
			}
			
		}
		
		$lng = SpokenLanguage::getVersionWiseData($versionId);
		foreach ($lng as $l) {
			if(!empty($l->language_id ))
				{
					$language=LanguagesList::find($l->language_id);
					$languagename=$language->name;
				}
				else{
					$languagename='';
				}
			$lngData[] = [
				'language' => trim($languagename),
				'listening' => $l->listening,
				'speaking' => $l->speaking,
				'reading' => $l->reading,
				'writing' => $l->writing
			];
		}
		
		$int = Interest::getVersionWiseData($versionId);
		foreach ($int as $one) {
			$interest = [
				'name' => $one->interest,
				'revision' => $one->description
			];
			$exists = true;
			// if (count($one->revisions)) {
				// $i = 1;
				// foreach ($one->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $interest["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }
				
			// }
			if ($exists) {
				$intData[] = $interest;
			}
			
		}
		
		$qua = Qualification::getVersionWiseData($versionId);
		foreach ($qua as $one) {
			$qualification = [
				'name' => $one->qualification,
				'revision' => $one->description
			];
			$exists = true;
			// if (count($one->revisions)) {
				// $i = 1;
				// foreach ($one->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $qualification["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }
				
			// }
			if ($exists) {
				$quaData[] = $qualification;
			}
			
		}
		
		// Include classes
		$p = app_path();
		require($p.'/tbs/tbs_class.php'); 
		require($p.'/tbs/tbs_plugin_opentbs.php');

		// prevent from a PHP configuration problem when using mktime() and date()
		if (ini_get('date.timezone')=='') {
		    date_default_timezone_set('UTC');
		}

		// Initialize the TBS instance
		$TBS = new \clsTinyButStrong; // new instance of TBS
        $TBS->SetOption('noerr', true);
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

		
		$TBS->LoadTemplate($fullPath, OPENTBS_ALREADY_UTF8);
		
		// merge body
		$TBS->MergeBlock('1ID', $userData);
		$TBS->MergeBlock('exp', $expData);
		$TBS->MergeBlock('proj', $projData);
		$TBS->MergeBlock('edu', $eduData);
		$TBS->MergeBlock('ref', $refData);
		$TBS->MergeBlock('lng', $lngData);
		$TBS->MergeBlock('qua', $quaData);
		$TBS->MergeBlock('int', $intData);
		
		// merge header - docx
        if ($TBS->Plugin(OPENTBS_FILEEXISTS, 'word/header1.xml')) {
		    $TBS->PlugIn(OPENTBS_SELECT_HEADER);
		    $TBS->MergeBlock('1ID', $userData);
        }
		// merge footer - docx
        if ($TBS->Plugin(OPENTBS_FILEEXISTS, 'word/footer1.xml')) {
			$TBS->PlugIn(OPENTBS_SELECT_FOOTER);
			$TBS->MergeBlock('1ID', $userData);
        }
		
		if ($TBS->Plugin(OPENTBS_FILEEXISTS, 'styles.xml')) {
			$TBS->PlugIn(OPENTBS_SELECT_FOOTER);
			$TBS->MergeBlock('1ID', $userData);
        }
		
		// merge footer and header - odt
		if ($TBS->PlugIn(OPENTBS_SELECT_FILE, 'styles.xml')) {
			$TBS->MergeBlock('1ID', $userData);
		}
		
		// Output the result as a file on the server.
	    $TBS->Show(OPENTBS_FILE, $publicPath); 

		$headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'Content-Disposition: attachment;filename="' . $templateName . '"'];

		return response()->download($publicPath, $templateName, $headers);
	}

	public function deleteResume ($templateID)
	{
        $user = Auth::user();
		$template = ResumeTemplate::find($templateID);
		$toDelete = [
			//'pdf_preview' => storage_path() . '/app/public/'.$id.'/'.pathinfo($template->name, PATHINFO_FILENAME).'.pdf',
			'docx_download' => storage_path() . '/app/public/'.$user->id.'/'.$template->name,
			'docx_template' => storage_path() . '/app/' .$template->path
		];

		foreach($toDelete as $f) {
			if (file_exists($f)) {
				unlink($f);
			}
		}
		$template->delete();
		return redirect(route('resume_template.view'));
	}
	
	
	
	public function showResumeGeneratornew() {
		$user = Auth::user();
		$current=URL::current();
		$cpath=explode('public/',$current);
		
		$screen=DB::table('screen')->where('slug', $cpath[1])->first();
		$chiledscreen=DB::table('screen')->where('parent', $screen->id)->get();
		
		//////////fetch version fpr login user//////////
		
		$versions = BiographyVersion::where('user_id', $user->id)
		                ->orWhere("user_id", '0')
						->where('is_active','=','1')
						->orderBy('id','DESC')
						->get();
						
						
		$tmp = $user->getFields();
        $fields = [
			'user' => []
		];
		$fields['user'][] = [
                    'key' => 'email',
                    'alias' => "[1ID.email]",
                    'value' => null
                ];
		$phones = $user->phones;
		$i = 1;
		foreach ($phones as $ph) {
			$fields['user'][] = [
                    'key' => 'phone'.$i,
                    'alias' => "[1ID.phone$i]",
                    'value' => null
                ];
			$i++;
		}
		//echo '<pre>';var_dump($phones);exit();
        $allowed = ['text', 'date', 'email', 'number', 'select'];
        foreach ($tmp as $k => $v) {
            if (in_array($v['type'], $allowed) && $k != 'selected_lang') {
                $fields['user'][] = [
                    'key' => $k,
                    'alias' => "[1ID.$k]",
                    'value' => null
                ];
            }
        }
		
		$fields['experience'] = [
			'exp.company' => [
				'alias' => '[exp.company;block=tbs:row]', 
				'alias2' => '[exp.company;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'exp.role' => [
				'alias' => '[exp.role;block=tbs:row]', 
				'alias2' => '[exp.role;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'exp.from_date' => [
				'alias' => '[exp.from_date;block=tbs:row]',
				'alias2' => '[exp.from_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'exp.to_date' => [
				'alias' => '[exp.to_date;block=tbs:row]', 
				'alias2' => '[exp.to_date;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'exp.revision1' => ['alias' => '[exp.revision]', 'value' => []]
		];
		
		
		$fields['projects'] = [
			'proj.company' => [
				'alias' => '[proj.company;block=tbs:row]',
				'alias2' => '[proj.company;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.customer' => [
				'alias' => '[proj.customer;block=tbs:row]',
				'alias2' => '[proj.customer;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.project_name' => [
				'alias' => '[proj.project_name;block=tbs:row]',
				'alias2' => '[proj.project_name;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.job_title' => [
				'alias' => '[proj.job_title;block=tbs:row]',
				'alias2' => '[proj.job_title;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.from_date' => [
				'alias' => '[proj.from_date;block=tbs:row]',
				'alias2' => '[proj.from_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.to_date' => [
				'alias' => '[proj.to_date;block=tbs:row]',
				'alias2' => '[proj.to_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'proj.revision1' => ['alias' => '[proj.revision]', 'value' => []]
		];
		$fields['education'] = [
			'edu.course' => [
				'alias' => '[edu.course;block=tbs:row]',
				'alias2' => '[edu.course;block=tbs:row+tbs:row]',
				'value' => []
			],
			'edu.institution' => [
				'alias' => '[edu.institution;block=tbs:row]', 
				'alias2' => '[edu.institution;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'edu.from_date' => [
				'alias' => '[edu.from_date;block=tbs:row]',
				'alias2' => '[edu.from_date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'edu.to_date' => [
				'alias' => '[edu.to_date;block=tbs:row]', 
				'alias2' => '[edu.to_date;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'edu.revision1' => ['alias' => '[edu.revision]', 'value' => []]
		];
		$fields['references'] = [
			'ref.customer' => [
				'alias' => '[ref.customer;block=tbs:row]', 
				'alias2' => '[ref.customer;block=tbs:row+tbs:row]', 
				'value' => []
			],
			'ref.person' => [
				'alias' => '[ref.person;block=tbs:row]',
				'alias2' => '[ref.person;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.job_title' => [
				'alias' => '[ref.job_title;block=tbs:row]',
				'alias2' => '[ref.job_title;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.date' => [
				'alias' => '[ref.date;block=tbs:row]',
				'alias2' => '[ref.date;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.position' => [
				'alias' => '[ref.position;block=tbs:row]',
				'alias2' => '[ref.position;block=tbs:row+tbs:row]',
				'value' => []
			],
			'ref.revision1' => ['alias' => '[ref.revision]', 'value' => []]
		];
		$fields['language'] = [
			'lng.language' => [
				'alias' => '[lng.language;block=tbs:row]',
				'alias2' => '[lng.language;block=tbs:row+tbs:row]',
				'value' => []
			],
			'lng.listening' => ['alias' => '[lng.listening;block=tbs:row]', 'value' => []],
			'lng.speaking' => ['alias' => '[lng.speaking;block=tbs:row]', 'value' => []],
			'lng.reading' => ['alias' => '[lng.reading;block=tbs:row]', 'value' => []],
			'lng.writing' => ['alias' => '[lng.writing;block=tbs:row]', 'value' => []]
		];
		
		$fields['interests'] = [
			'int.name' => [
				'alias' => '[int.name;block=tbs:row]',
				'alias2' => '[int.name;block=tbs:row+tbs:row]',
				'value' => []
			],
			'int.revision1' => ['alias' => '[int.revision]', 'value' => []]
		];
		
		$fields['qualifications'] = [
			'qua.name' => [
				'alias' => '[qua.name;block=tbs:row]',
				'alias2' => '[qua.name;block=tbs:row+tbs:row]',
				'value' => []
			],
			'qua.revision1' => ['alias' => '[qua.revision]', 'value' => []]
		];
		
        // $tmpl = $user->resumeTemplates;
        // $templates = [];
        // foreach ($tmpl as $t) {
            // $templates[$t->id] = $t->name;
        // }

		return view('member.resume-generator.resume_new', [
			'user' => $user,
			'chiledscreen'=>$chiledscreen,
			'versions'=>$versions,           
			'fields' => $fields
		]);
	}
	
	
	public function posttemplate(Request $request)
	{
		$input=$_POST;		
		$storage_folder = DB::table('sy_file_folders')->where('TABLE', 'UD_CV_TEMPLATES')->first();
		$st=explode('/Storage/',$storage_folder->path);
		//echo '<pre>';print_r($st);exit;
		
		if (!empty($request->file('template'))) {
            $user = Auth::user();
		        $path =$request->file('template')->store($st[1].'/'.$user->id);
		}
			$userId = Auth::user()->id;
			$data['UID']=$userId;
			$data['name']=$input['name'];
			$data['description']=$input['description'];
			$data['filename']=$request->file('template')->getClientOriginalName();
			$data['path']=$path;
			$data['template_date']=date('Y-m-d');
			$data['template_time']=date('h:i:s');
			if(isset($input['shared']) && ($input['shared']=='on'))
			{
				$data['shared']="x";
			}
			else{
				$data['shared']=" ";
			}
			//echo '<pre>';
		 //print_r($_FILES);exit;
		 //print_r($data);exit;
			
		if (UserCvTemplate::create($data)) {
			session()->flash('status', 'Your Post save Successfully!');
		} else {
			session()->flash('status', 'Please Try Again!');
		}
			exit;
		 //return redirect('resume-generator-new');
	}
	
	
	function gettemplate()
	{
		$popid=$_POST['popupid'];
		$versionid=$_POST['versionid'];
		$user = Auth::user();
		$tmpl = $user->CVTemplates;
		$defaulttemplate=DB::table('conf_cv_templates')->get();		
		$othertemplate=DB::table('ud_cv_templates')->where('UID','!=', $user->id)->where('shared', 'x')->get();
        $templates = [];
        if($tmpl)
		{
        foreach ($tmpl as $t) {
            $templates[$t->id] = $t->name;
        }
		}
		return view('member.resume-generator.template',compact('popid','templates','defaulttemplate','othertemplate','versionid'));
		
	}
	
	
	public function downloadResumeNew ($templateID,$versionId,$popupid)
	{
		$user = Auth::user();
		$input = Input::all();
		$revision = empty($input['revision']) ? 1: (int) $input['revision'];
		
		$templateName = $fullPath = $publicPath = '';
		
		if ($templateID === 'example' ) {
			$templateName = 'Example_Template.docx';
			$fullPath = storage_path() . '/Example_Template.docx';
			$publicPath = storage_path() . '/app/public/Example_Template.docx';
			//$versionId = BiographyVersion::getVersionId($user->id);
			
		} elseif ($templateID === 'example2' ) {
			$templateName = 'Example_Two_Rows.docx';
			$fullPath = storage_path() . '/Example_Two_Rows.docx';
			$publicPath = storage_path() . '/app/public/Example_Two_Rows.docx';
			//$versionId = BiographyVersion::getVersionId($user->id);
		} else {
			
			if($popupid=='templates_shared')
			{
				$template =DB::table('ud_cv_templates')->where('id', $templateID)->first();
					$templateName = $template->filename;
			    //$versionId = $template->version_id;
			    $fullPath = storage_path(). '/app/' . $template->path;
        		//	$publicPath = storage_path() . '/app/CVTemplates/'.$user->id.'/';
        		$publicPath = storage_path() . '/app/public/'.$template->UID.'/';
        			
			}
			else{
				
				$template = $user->CVTemplates->find($templateID);
					$templateName = $template->filename;
			        $fullPath = storage_path(). '/app/' . $template->path;
            		$publicPath = storage_path() . '/app/public/'.$user->id.'/';
            			
			}
			
			if (!file_exists($fullPath)) {
				echo ("Template not found");
				exit;
            }
			
			if (!file_exists($publicPath)) {
            				mkdir($publicPath, 0777, true);
            			}
		
			$publicPath .= $templateName;
			
		    //	$publicPath .= "Test.docx";
		}
		
		if(!empty($versionId)){ $versionId = $versionId; } else { $versionId = '0'; }
		
		$userData = $refData = $expData = $projData = $eduData = $lngData = $intData = $quaData = [];
		
		$tmp = $user->getFields();
        $allowed = ['text', 'date', 'email', 'number', 'file', 'select'];
        foreach ($tmp as $k => $v) {
            if (in_array($v['type'], $allowed) && $k != 'selected_lang') {
				$userData[0][$k] = isset($user->$k) ? $user->$k : '';
            }
        }
		
		$userData[0]['email'] = $user->email;
		$phones = $user->phones;
		$i = 1;
		foreach ($phones as $ph) {
			$userData[0]['phone'.$i] = $ph->content;
			$i++;
		}
		
		if (!empty($userData[0]['avatar'])) {
			$userData[0]['avatar'] = public_path('profiles') . '/' . $userData[0]['avatar'];
		}
		
		// additional user data (select fields)
		$country = $user->country()
				//->where('lang', strtoupper(\App::getLocale()))
				->first();
		$countryOfBirth = $user->countryOfBirth()
				//->where('lang', strtoupper(\App::getLocale()))
				->first();
			
		
		$userData[0]['blood_type'] = $user->getBloodType();
		$userData[0]['country'] = empty($country) ? '' : $country->toArray()['country'];
		$userData[0]['country_of_birth'] = empty($countryOfBirth) ? '' : $countryOfBirth->toArray()['country'];
		
		$exp = WorkExperience::getVersionWiseData($versionId);
		// echo '<pre>';
		// print_r($exp);
		// echo '</pre>';
		// die();
		foreach ($exp as $e) {
			$element = [
				'company' => $e['company_name'],
				'role' => $e['job_title'],
				'from_date' => empty($e['start_date']) ? '?' : $e['start_date'],
				'to_date' => empty($e['end_date']) ? '?' : $e['end_date'],
				'revision' => $e['description']
			];
			$exists = true;
			/*if (count($e->revisions)) {
				$i = 1;
				foreach ($e->revisions as $rev) {
					if ($rev->name == (string) $revision) {
						$element["revision"] = $rev->text;
						$exists = true;
					}					
					$i++;
				}				
			}*/
			if ($exists) {
				$expData[] = $element;
			}
			
		}
		
		$proj = Project::getVersionWiseData($versionId);
		foreach ($proj as $p) {
			if(!empty($p->work_experience_id))
				{
					$company=WorkExperience::find($p->work_experience_id);
					$companyname=$company->company_name;
				}
				else{
					$companyname='';
				}
			$project = [
				'company' => $companyname,
				'customer' => $p->customer_name,
				'project_name' => $p->project_name,
				'job_title' => $p->job_title,
				'from_date' => $p->start_date,
				'to_date' => $p->end_date,
				'revision' => $p->description
			];
			$exists = true;
			// if (count($p->revisions)) {
				// $i = 1;
				// foreach ($p->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $project["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }				
			// }
			if ($exists) {
				$projData[] = $project;
			}
			
		}
		
		$edu = Education::getVersionWiseData($versionId);
		foreach ($edu as $e) {
			$education = [
				'course' => $e->course_name,
				'institution' => $e->institution_name,
				'from_date' => $e->start_date,
				'to_date' => $e->end_date,
				'revision' => $e->description
			];
			$exists = true;
			// if (count($e->revisions)) {
				// $i = 1;
				// foreach ($e->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $education["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }				
			// }
			if ($exists) {
				$eduData[] = $education;
			}
			
		}
		
		$ref = References::getVersionWiseData($versionId);
		foreach ($ref as $r) {
			if(!empty($r->project_id ))
				{
					$project=Project::find($r->project_id);
					$projectname=$project->project_name;
				}
				else{
					$projectname='';
				}
			$reference = [
				'customer' => $projectname,
				'person' => $r->person_name,
				'job_title' => $r->job_title,
				'date' => $r->reference_date,
				'position' => $r->job_position,
				'revision' => $r->description
			];
			$exists = true;
			// if (count($r->revisions)) {
				// $i = 1;
				// foreach ($r->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $reference["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }
				
			// }
			if ($exists) {
				$refData[] = $reference;
			}
			
		}
		
		$lng = SpokenLanguage::getVersionWiseData($versionId);
		foreach ($lng as $l) {
			if(!empty($l->language_id ))
				{
					$language=LanguagesList::find($l->language_id);
					$languagename=$language->name;
				}
				else{
					$languagename='';
				}
			$lngData[] = [
				'language' => trim($languagename),
				'listening' => $l->listening,
				'speaking' => $l->speaking,
				'reading' => $l->reading,
				'writing' => $l->writing
			];
		}
		
		$int = Interest::getVersionWiseData($versionId);
		foreach ($int as $one) {
			$interest = [
				'name' => $one->interest,
				'revision' => $one->description
			];
			$exists = true;
			// if (count($one->revisions)) {
				// $i = 1;
				// foreach ($one->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $interest["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }
				
			// }
			if ($exists) {
				$intData[] = $interest;
			}
			
		}
		
		$qua = Qualification::getVersionWiseData($versionId);
		foreach ($qua as $one) {
			$qualification = [
				'name' => $one->qualification,
				'revision' => $one->description
			];
			$exists = true;
			// if (count($one->revisions)) {
				// $i = 1;
				// foreach ($one->revisions as $rev) {
					// if ($rev->name == (string) $revision) {
						// $qualification["revision"] = $rev->text;
						// $exists = true;
					// }					
					// $i++;
				// }
				
			// }
			if ($exists) {
				$quaData[] = $qualification;
			}
			
		}
		
		// Include classes
		$p = app_path();
		require($p.'/tbs/tbs_class.php'); 
		require($p.'/tbs/tbs_plugin_opentbs.php');

		// prevent from a PHP configuration problem when using mktime() and date()
		if (ini_get('date.timezone')=='') {
		    date_default_timezone_set('UTC');
		}

		// Initialize the TBS instance
		$TBS = new \clsTinyButStrong; // new instance of TBS
        $TBS->SetOption('noerr', true);
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

		
		$TBS->LoadTemplate($fullPath, OPENTBS_ALREADY_UTF8);
		
		// merge body
		$TBS->MergeBlock('1ID', $userData);
		$TBS->MergeBlock('exp', $expData);
		$TBS->MergeBlock('proj', $projData);
		$TBS->MergeBlock('edu', $eduData);
		$TBS->MergeBlock('ref', $refData);
		$TBS->MergeBlock('lng', $lngData);
		$TBS->MergeBlock('qua', $quaData);
		$TBS->MergeBlock('int', $intData);
		
		// merge header - docx
        if ($TBS->Plugin(OPENTBS_FILEEXISTS, 'word/header1.xml')) {
		    $TBS->PlugIn(OPENTBS_SELECT_HEADER);
		    $TBS->MergeBlock('1ID', $userData);
        }
		// merge footer - docx
        if ($TBS->Plugin(OPENTBS_FILEEXISTS, 'word/footer1.xml')) {
			$TBS->PlugIn(OPENTBS_SELECT_FOOTER);
			$TBS->MergeBlock('1ID', $userData);
        }
		
		if ($TBS->Plugin(OPENTBS_FILEEXISTS, 'styles.xml')) {
			$TBS->PlugIn(OPENTBS_SELECT_FOOTER);
			$TBS->MergeBlock('1ID', $userData);
        }
		
		// merge footer and header - odt
		if ($TBS->PlugIn(OPENTBS_SELECT_FILE, 'styles.xml')) {
			$TBS->MergeBlock('1ID', $userData);
		}
		
		
		// Output the result as a file on the server.
	    $TBS->Show(OPENTBS_FILE, $publicPath); 

		$headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'Content-Disposition: attachment;filename="' . $templateName . '"'];

		return response()->download($publicPath, $templateName, $headers);
	}
	
	public function deletenewResume($templateID)
	{
		$user = Auth::user();
		$template = UserCvTemplate::find($templateID);
		$toDelete = [
			//'pdf_preview' => storage_path() . '/app/public/'.$id.'/'.pathinfo($template->name, PATHINFO_FILENAME).'.pdf',
			'docx_download' => storage_path() . '/app/public/'.$user->id.'/'.$template->name,
			'docx_template' => storage_path() . '/app/' .$template->filename
		];

		foreach($toDelete as $f) {
			if (file_exists($f)) {
				unlink($f);
			}
		}
		$template->delete();
		return redirect(route('resume_template.resume-generator-new'));
	}
	
	
	

}
