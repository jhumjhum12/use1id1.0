<?php

namespace App\Models;


use Auth;
use Input;
use URL;
use App\Models\CompanyUser;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;
use YoHang88\LetterAvatar\LetterAvatar;


class Company extends Model
{
	use ValidationTrait;

//    protected $table = "CD_GEN_COMPANY"; // DV0001
    protected $table = "companies";  // DV0001
    protected $guarded = [ "user_id", "id"];
    public $timestamps = false;

    public function getFields()
    {
        return
            [
                'name'=> [ 'label'=>'name', 'validation'=>'required', 'type'=>'text'  ],
                'registration_number'=> [ 'label'=>'registration_number', 'validation'=>'', 'type'=>'text'  ],
                'website'=> [ 'label'=>'website', 'validation'=>'', 'type'=>'text'  ],
                'logo'=> [ 'label'=>'logo', 'validation'=>'', 'type'=>'file'  ],
            ];
    }




    public function afterSave($data, $originalData, $resource_id)
    {
        if(Input::file())
        {
            $company = self::where("id", $resource_id)->where("user_id", Auth::user()->id)->firstOrFail();
            $image = Input::file('logo');
            $filename  = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('logos/' . $filename);

            Image::make($image->getRealPath())->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $company->logo = $filename;
            $company->save();
        }

    }


    public function getImage() {
        if($this->logo) return URL::to('logos/' . $this->logo);
        else {
            return new LetterAvatar($this->name, 'square', 200);
        }
    }

    public function isContact($user_id, $type)
    {
        $existing = CompanyUser::where("user_id", $user_id)
            ->where("company_id", $this->id)
            ->where("type", $type)
            ->where("status", 1)
            ->first();
        return ($existing) ? true : false;

    }

}
