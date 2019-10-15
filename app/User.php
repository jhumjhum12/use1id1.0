<?php

namespace App;

use App\Models\ContactInfo;
use App\Models\ResumeTemplates;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Input;
use Validator;
use Notification;
use Request;
use Session;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use App\Http\Traits\ValidationTrait;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use YoHang88\LetterAvatar\LetterAvatar;

class User extends Authenticatable
{

    use
        ValidationTrait,
        HasApiTokens, Notifiable;

	/**
	 * Define user access constants
	 */
// DV0001 Should be derived from a configuration table	 
	const USER_DEFAULT = 10;
	const USER_BANNED = -1;
	const USER_ADMIN = 100;

// DV0001 Should be derived from a configuration table
	private static $bloodTypes = ['0+', '0-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [
    //    'first_name', 'last_name', 'middle_name', "birthday", "country_of_birth", "blood_type", "city_of_birth", "selected_lang", "street", "house_number", "postal_code", "country", "nickname"
    //];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'password', 'remember_token', 'activated', 'activation_code', 'personal_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'activated', 'personal_id'
    ];

    public function getFields()
    {
        return
        [
            'first_name'=> [ 'name'=>'first_name', 'validation'=>'required', 'type'=>'text'  ],
            'middle_name'=> ['name'=>'middle_name', 'validation' => '', 'type'=>'text'],
            'last_name'=> [ 'name'=>'last_name', 'validation'=>'required', 'type'=>'text'  ],
            'nickname'=> ['name'=>'nickname', 'validation' => '', 'type'=>'text'],
// DV0001 Should be derived from a configuration table            
            'gender'=> ['name'=>'gender', 'validation' => '', 'type'=>'select', 'options'=>[null=>'', 'm'=>Label::get('male'), 'f'=>Label::get('female')]],
            // 'email'=> [ 'name'=>'email', 'validation'=>'required', 'type'=>'email'  ],
            // 'password'=> [ 'name'=>'password', 'validation'=>'required', 'type'=>'password'  ],
            'projects'=> [ 'name'=>'projects', 'validation'=>'', 'type'=>'external'  ],
            'birthday'=> ['name'=>'birthday', 'validation'=>'', 'type'=>'date'],
            'country_of_birth' => ['name'=>'country_of_birth', 'validation'=>'', 'type'=>'select', 'options'=>Translate::countriesList() ],
            'city_of_birth' => ['name'=>'city_of_birth', 'validation'=>'', 'type'=>'text' ],
            'blood_type' => ['name'=>'blood_type', 'validation'=>'', 'type'=>'select', 'options'=>self::bloodTypeOptions() ],
            'selected_lang' => ['name'=>'selected_lang', 'validation'=>'required', 'type'=>'select', 'options'=> Language::getAllIds()],
            'street' => ['name'=>'street', 'validation'=>'', 'type'=>'text' ],
            'house_number' => ['name'=>'house_number', 'validation'=>'', 'type'=>'text' ],
            'place' => ['name'=>'place', 'validation'=>'', 'type'=>'text' ],
            'province' => ['name'=>'place', 'validation'=>'', 'type'=>'text' ],
            'city' => ['name'=>'place', 'validation'=>'', 'type'=>'text' ],
            'postal_code' => ['name'=>'postal_code', 'validation'=>'', 'type'=>'text' ],
            'country' => ['name'=>'country', 'validation'=>'', 'type'=>'select', 'options'=>Translate::countriesList() ],
            'avatar' => ['name'=>'avatar', 'validation'=>'', 'type'=>'file' ],
            'contacts[]'=> [ 'label'=>'', 'validation'=>'', 'type'=>'contacts-list'  ],
        ];
    }

    /**
     * Overrides
     * @param string $token
     */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /*
     * Relations
     */

	public function country()
	{
		return $this->hasOne('App\Country', 'A2_ISO', 'country');
	}
	
	public function countryOfBirth()
	{
		return $this->hasOne('App\Country', 'A2_ISO', 'country_of_birth');
	}
	
	public function getBloodType()
	{
        if(isset(self::bloodTypeOptions()[$this->blood_type])) {
            return self::bloodTypeOptions()[$this->blood_type];
        }
        else return "";
	}
	
    public function workExperience()
    {
        return $this->hasMany('App\Models\WorkExperience');
    }
	
	public function phones()
    {
        return $this->hasMany('App\Models\ContactInfo');
    }

    public function resumeTemplates()
    {
        return $this->hasMany('App\Models\ResumeTemplate');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
	
	public function interests()
    {
        return $this->hasMany('App\Models\Interest');
    }
	
	public function qualifications()
    {
        return $this->hasMany('App\Models\Qualification');
    }
	
	public function references()
    {
        return $this->hasMany('App\Models\References');
    }

    public function education()
    {
        return $this->hasMany('App\Models\Education');
    }

    public function contactInfo()
    {
        return $this->hasMany('App\Models\ContactInfo');
    }

    public function companies()
    {
        return $this->hasMany('App\Models\Company');
    }

    public function employee()
    {
        return $this->hasMany('App\Models\CompanyUser');
    }

    public function bankAccountsCards()
    {
        return $this->hasMany('App\Models\BankAccountsCards');
    }

	public function access()
    {
        return $this->hasOne('App\Access', 'id');
    }

	public function reference()
    {
        return $this->hasOne('App\User', 'id', 'reference_user');
    }

    public function bankAccountsPaypal()
    {
        return $this->hasMany('App\Models\BankAccountsPaypal');
    }

	public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }

    public function tags()
	{
		return $this->hasMany('App\Models\Tag');
	}
	
	public function spokenLanguages()
	{
		return $this->hasMany('App\Models\SpokenLanguage');
	}

	public function language()
    {
         return $this->belongsTo('App\Language', 'selected_lang');
    }


      public function CVTemplates()
		{
			return $this->hasMany('App\Models\UserCvTemplate','UID');
		}
		
		
		public function CVTemplatesother()
		{
			return $this->hasMany('App\Models\UserCvTemplate');
		}

    /**
     * Data Providers
     */

    public function lang()
    {
        $langs = \App\Language::getLangId();
        return strtolower( $langs[ strtoupper($this->selected_lang) ]);
    }

    /**
     * Getters
     */

    public function getPersonalId()
    {
        return $this->id;
        //$padded = str_pad($this->id, 16, "0", STR_PAD_LEFT);
        //return rtrim(chunk_split($padded, 4, "."), ".");
    }

    public function getQRCode()
    {
        // todo implement
// DV0001 Should be derived from a configuration table        
        $url = URL::to('contacts/view/' . $this->personal_id);
        return "//api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . $url;
    }

    public function getGender()
    {
// DV0001 Should be derived from a configuration table        
        if($this->gender=="m") return Label::get('male');
        if($this->gender=="f") return Label::get('female');
        return "";
    }

    /**
     * Actions
     */



    public function get_single()
    {
        return \App\User::where("id", Auth::user()->id)->firstOrFail();
    }

    public function change_password()
    {
        $data = Input::all();
        $validator = Validator::make($data, [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);

        if($validator->passes()){
            Auth::user()->password = bcrypt($data['password']);
            Auth::user()->save();
            Notification::success("Password updated");
            return true;
        } else {
            return $validator->messages();
        }


    }

    public function create_or_update($payload=null, $segment=null)
    {

        $user = self::where("id", Auth::user()->id)->firstOrFail();
        $dataOriginal = $_POST;

        $data = Input::all();
        $data = $this->transformFields($data);
        $user->fill($data);
        $isValid = $user->validate($data, $segment);

        if($isValid->passes()){

            if(Input::file())
            {

                $image = Input::file('avatar');
                $filename  = time() . '.' . $image->getClientOriginalExtension();

                $path = public_path('profiles/' . $filename);

                Image::make($image->getRealPath())->fit(200, 200)->save($path);
                $user->avatar = $filename;
            }

            $user->save();

            $this->afterSave($data, $dataOriginal, null );

            return true;

        } else {
            return $isValid->messages();

        }

    }

    public function register()
    {
        exit("!");
    }

    public function delete()
    {
        exit("!");
    }

    public function getName()
    {
        return $this->first_name . " " . $this->last_name;
    }



    public function getContacts()
    {
        return \App\User::all();
    }


    public function sayHello($data)
    {
// DV0001 Should be derived from a configuration table        
        exit("Hello " . $data['first_name']);
    }



    public function updateObject($data)
    {
        $id = Auth::user()->id;

        $user = \App\User::find($id);

        if (!$user->update(Input::all())) {
            return Redirect::back()
// DV0001 Should be derived from a configuration table            
                ->with('message', 'Something wrong happened while saving your model')
                ->withInput();
        } else {
        }

        //$address = \App\Address::find($user->id);
        //$address->update(Input::get('addresses'));

        // var_dump($data); exit();
    }

    public function getImage() {
        if($this->avatar) return URL::to('profiles/' . $this->avatar);
        else {
            return new LetterAvatar($this->getName(), 'square', 200);
        }
    }

    public function isAdmin()
    {
// DV0001 Should be derived from a configuration table        
        if(isset($this->access->level) && $this->access->level==100) return true; else return false;
        return $this->admin; // this looks for an admin column in your users table
    }

    public function afterSave($data, $originalData, $resource_id)
    {

        if(empty($originalData['contacts']) || !is_array($originalData['contacts'])) {
        } else {
            $options = ContactInfo::optionsProvider();
            // drop bookmark-tag relations for given document and reconstruct them from the scratch
            DB::table("contact_info")->where("user_id", Auth::user()->id)->delete();

            foreach ($originalData['contacts'] as $c) {
			if(!empty($c['type']) && !empty($c['content'])){
					if (isset($options[$c['type']])) {
						DB::table("contact_info")->insert(
							[
								"user_id" => Auth::user()->id,
								"type" => $c['type'],
								"content" => $c['content']
							]
						);
					}
				}
            }
        }

// DV0001 Should be derived from a configuration table
        if(Auth::user()->email=="elvis.presley@use1id.com") {
            $redirect_uri = route('google.update', ['back'=>Request::fullUrl()]);
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            exit();
        }

        return true;

    }

    public function getFirstPhone()
    {
//        $phone = DB::table("UD_GEN_CON_CONTACT_INFO") // DV0001        
        $phone = DB::table("contact_info")  // DV0001
            ->where("user_id", Auth::user()->id)
            ->whereIn("type", [1,2])
            ->first();
        if($phone) return $phone->content; else return "";

    }

    public function getFullAddress()
    {
        return $this->street . " " .
        $this->house_number . ", " . $this->postal_code . " " . $this->city . ", " . Label::getCountry($this->country);
//         . " " .  . ", " . $this->country->key;
    }

    public static function bloodTypeOptions()
    {
// DV0001 Should be derived from a configuration table        
        return [
            '0'=>null,
            '1'=>'0+',
            '2'=>'0-',
            '3'=>'A+',
            '4'=>'A-',
            '5'=>'B+',
            '6'=>'B-',
            '7'=>'AB+',
            '8'=>'AB-',
        ];
    }


}
