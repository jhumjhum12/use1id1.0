<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class BiographyVersion extends Model
{
	//use ValidationTrait;

	protected $table = "ud_gen_bio_versions"; 
	//protected $guarded = [ "user_id", "id"];
	
    
	
	protected $fillable = [
        'version', 'introduction','user_id'
    ];
	 
    public function getFields()
    {
        return
            [
                'version'=> [ 'label'=>'version', 'validation'=>'required', 'type'=>'text'  ],
                'introduction'=> [ 'label'=>'introduction', 'validation'=>'required', 'type'=>'text'  ],
                
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
            'data'=>self::where("user_id", Auth::user()->id)->orderBy('created_at', 'asc')->get(),
            'db_table'=>$this->getDBTable(),
            'buttons'=>['edit']
        ];

    }
	
	
	public static $rules = array(
		'version'=>'required'
	);
	public static $custom_messages =array(
		'version.required' => 'Version Name is Required'
	);

    public static function getVersionId($id)
    {
        return self::where('user_id', $id)->orderBy('id','DESC')->pluck('id')->first();
    } 
    
}
