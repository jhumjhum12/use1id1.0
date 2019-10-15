<?php

namespace App\Models;


use Auth;
use Input;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class SpokenLanguage extends Model
{
	use ValidationTrait;

     protected $table = "ud_gen_bio_languages"; // DV0001
   // protected $table = "spoken_languages";  // DV0001
    protected $guarded = [ "user_id", "id"];
    public $timestamps = false;
    const REVISION_TYPE = Revision::REVISION_LANGUAGES;

    public function getFields()
    {
        return
            [
//                'languages_list_id' => ['label'=>'languages_list_id', 'validation'=>'required', 'type'=>'select', 'options'=>DB::table('CONF_MD_LANGUAGES')->orderBy("name")->pluck('name', 'id')->prepend('', 0)], // DV0001
                'language_id' => ['label'=>'language_id', 'validation'=>'required', 'type'=>'select', 'options'=>DB::table('languages_list')->orderBy("name")->pluck('name', 'id')->prepend('', 0)],  // DV0001
                'listening'=> [ 'label'=>'listening', 'validation'=>'', 'type'=>'text'  ],
                'speaking'=> [ 'label'=>'speaking', 'validation'=>'', 'type'=>'text'  ],
                'reading'=> [ 'label'=>'reading', 'validation'=>'', 'type'=>'text'  ],
                'writing'=> [ 'label'=>'writing', 'validation'=>'', 'type'=>'text'  ],
                 'version_id'=> [ 'label'=>'Versions', 'validation'=>'required', 'type'=>'select', 'options'=>BiographyVersion::where("user_id", Auth::user()->id)->get()->pluck("version", "id")->prepend('Select Version', '')],	
            ];
    }

    public function language()
    {
        return $this->hasOne('App\LanguagesList', 'id', 'languages_list_id');
    }


    public function languagesList() {
		return $this->belongsTo('App\LanguagesList', 'languages_list_id');
	}
	
	public static function getVersionWiseData($id)
    {
        return self::where('version_id', $id)->get();
    } 


}
