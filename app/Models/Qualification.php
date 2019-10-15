<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class Qualification extends Model
{
    use ValidationTrait;

     protected $table = "ud_gen_bio_qualifications";  // DV0001
    //protected $table = "qualifications";  // DV0001
    protected $guarded = [ "user_id", "id"];
    public $timestamps = false;
    const REVISION_TYPE = Revision::REVISION_QUALIFICATIONS;

    public function getFields()
    {
        return
            [
                'name'=> [ 'label'=>'name', 'validation'=>'required', 'type'=>'text'  ],
                 'version_id'=> [ 'label'=>'Versions', 'validation'=>'required', 'type'=>'select', 'options'=>BiographyVersion::where("user_id", Auth::user()->id)->get()->pluck("version", "id")->prepend('Select Version', '')],	
            ];
    }

    /*
     * Relations
     */

    public function revisions()
    {
        return $this->hasMany('App\Models\Revision', 'resource_id', 'id')
            ->where("type", self::REVISION_TYPE )
            ->where("user_id", Auth::user()->id);
    }
    
    
    public static function getVersionWiseData($id)
    {
        return self::where('version_id', $id)->get();
    } 


}
