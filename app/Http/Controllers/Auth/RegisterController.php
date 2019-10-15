<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Input;
use Mail;
use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/general-data';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $code = Input::get('code');
        $reference_user = null;
        $activated = 0;
        $activationCode = rand(11111111,99999999);
        if($code) {
            $invitation = DB::table('invitations')->where('code', $code)->first();
            if($invitation && $invitation->inviter_id) {
                $inviter = \App\User::where("id", $invitation->inviter_id)->first();
                if($inviter) {
                    $reference_user = $inviter->id;
                    $activated = 1;
                    $activationCode = null;
                }
            }
        }

        $user = new User;
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->reference_user = $reference_user;
        $user->email = $data['email'];
        $user->selected_lang = $data['selected_lang'];
        $user->personal_email = $data['email'];
        $user->personal_id = 0;
        $user->password =  bcrypt($data['password']);
        $user->personal_id = uniqid();
        $user->activated = $activated;
        $user->activation_code = $activationCode;
        $user->save();

        if($activated==0) {
            $url = route('auth.email.verification', ['email'=>$user->email, 'code'=>$activationCode]);
            Mail::send('emails.auth.confirmation', ['user' => $user, 'url' => $url], function ($m) use ($user) {
                $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
                $m->to( $user->email )->subject('Email-confirmation');
            });
        }

        // create relation if $inviter is present
        if(isset($code)) {
            DB::table("invitations")->where("code", $code)->update([
                "status"=>1
            ]);
        }
        if(isset($inviter) && $inviter->id) {
            DB::table("contacts")->insert([
               "user_1"=>$inviter->id,
               "user_2"=>$user->id,
               "status"=>1,
            ]);
        }

        Mail::send('emails.auth.register-notification', ['user' => $user], function ($m){
            $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
            $m->to('user.feedback@use1id.com')->subject('New Registration');
        });
        return $user;

        
    }

    public function showRegistrationForm()
    {
        $invitation = null;
        $inviter = null;
        $email = Input::get('email');
        $code = Input::get('code');
        if($email && $code) {
            $invitation = DB::table('invitations')->where('code', $code)->where('email', $email)->first();
            if($invitation && $invitation->inviter_id) {
                $inviter = \App\User::where("id", $invitation->inviter_id)->first();
            }
        }
        return view('auth.register')
            ->with('inviter', $inviter)
            ->with('email', $email)
            ->with('invitation', $invitation);
    }


}
