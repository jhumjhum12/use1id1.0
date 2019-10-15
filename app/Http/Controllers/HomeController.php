<?php

namespace App\Http\Controllers;

use App;
use DB;
use App\Models\Language;
use Auth;
use Redirect;
use Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use App\ConfScrUiScreens;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getFirstPage()
    {
        if(Auth::check()) {
            return redirect('dashboard');
        } else {

        }
    }

    // test method, ignore

    public function setLanguage()
    {
        $set = strtoupper(Input::get("lang"));
        $available = \App\Language::getIdLang();
        if(!isset($available[$set])) $set = 'EN';
        App::setLocale(strtolower($available[$set]));
        if(Auth::user()->id) {
            Auth::user()->selected_lang = $available[$set];
            Auth::user()->save();
        }
        return redirect('dashboard');
    }

    public  function sendFeedback()
    {      
        $text = input::get('feedback');
        $type = input::get('feedback_type');
        $user = Auth::user();
        $url = input::get('current_url');
        
        Mail::send('emails.feedback.index', ['user' => $user, 'feedback' => $text, 'feedback_type' => $type, 'current_url' => $url], function ($m){
            $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
            $m->to('user.feedback@use1id.com')->subject('1ID Feedback');
        });

        return Redirect::back();
    }

    // test method, ignore

    public function emailTest()
    {
        return false;
        $text = "TEST";
        $type = "TEST";
        $user = Auth::user();
        $url = "PING TEST";

        Mail::send('emails.feedback.index', ['user' => $user, 'feedback' => $text, 'feedback_type' => $type, 'current_url' => $url], function ($m){
            $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
            $m->to('februarski@gmail.com')->subject('1ID Email Ping Test');
        });

        exit("OK");

    }

    // test method, ignore

    public function dumpUser()
    {
        return false;
        if(Auth::check()) {
            $user = \App\User::where("id", Auth::user()->id)
                ->with('workExperience')
                ->with('projects')
                ->with('education')
                ->with('contactInfo')
                ->with('bankAccountsCards')
                ->with('bankAccountsPaypal')
                ->firstOrFail();
            echo "<pre>";
            var_dump($user->toArray());
        } else {
            exit("No one logged in");
        }

    }

    // test method, ignore

    public function dumpXp()
    {
        return false;
        if(Auth::check()) {
            $xp = \App\Models\WorkExperience::where("id", 1)
                ->with('revisions')
                ->firstOrFail();

            $xp->company_name = "Acme Corp";
            $xp->revisions[0]->text = "Fine!";
            $xp->save();

            $xp = \App\Models\WorkExperience::where("id", 1)
                ->with('revisions')
                ->firstOrFail();
            echo "<pre>";

            $xp->save();
            var_dump($xp->toArray());
        } else {
            exit("No one logged in");
        }

    }


    public function verifyEmail($email, $code)
    {

        $activationSuccess = false;
        $user = \App\User::where("email", $email)->where("activation_code", $code)->first();
        if($user) {
            $user->activated = 1;
            $user->activation_code = null;
            $user->save();
            $activationSuccess = true;
        }

        return view('auth.confirmation')
            ->with('code', $code)
            ->with('user', $user)
            ->with("activationSuccess", $activationSuccess);

    }
}
