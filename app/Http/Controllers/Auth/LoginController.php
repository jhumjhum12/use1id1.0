<?php

namespace App\Http\Controllers\Auth;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;  
 use Illuminate\Support\Facades\Auth;  
 use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en';
        App::setLocale(  $lang );

        $this->middleware('guest', ['except' => 'logout']);
    }
	
	
	protected function sendLoginResponse(Request $request) { 
	
     $customRememberMeTimeInMinutes = 120;  
	 if($request->remember)
	 {
		 Cookie::queue(Cookie::make('useremail', $request->email, $customRememberMeTimeInMinutes));
		 Cookie::queue(Cookie::make('password', $request->password, $customRememberMeTimeInMinutes));
		 Cookie::queue(Cookie::make('test', '123', $customRememberMeTimeInMinutes));
		
	 }
	 else
	 {
		 Cookie::queue(Cookie::forget('test'));
		 Cookie::queue(Cookie::forget('useremail'));
		 Cookie::queue(Cookie::forget('password'));
	 }

	//$remember = Auth::getRecallerName();		
	
     
     $request->session()->regenerate();  
     $this->clearLoginAttempts($request);  
     return $this->authenticated($request, $this->guard()->user())  
         ?: redirect()->intended($this->redirectPath());  
   } 
}
