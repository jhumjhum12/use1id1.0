<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class UserCvTemplate extends Model
{
     protected $table = 'ud_cv_templates'; 
	 
	 protected $fillable = [
        'UID', 'name','description','filename','template_date','template_time','shared','path'
    ];
	
	
	public static $rules = array(
		'name'=>'required'
	);
	public static $custom_messages =array(
		'name.required' => 'Template Name is Required'
	);
}
