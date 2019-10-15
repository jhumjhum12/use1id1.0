<?php

namespace App\Http\Controllers;

use App;
use DB;
use Notification;
use App\ScreenBuilder\ScreenSegments;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\HTMLBuilder as HTMLBuilder;
use Illuminate\Support\Facades\Input;
use App\ScreenBuilder\Screen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RequestResolver extends Controller
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

    /**
     *
     * ROUTE RESOLVER
     * Main entry point for the app, instead of using routes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug="")
    {

        $this->setLanguage();

        // Scenario #1: POST REQUEST

        if ($request->isMethod('post'))
        {

            if(!$request->input('function')) {
                exit("Method not defined");
            }

         $function = $request->get('function');
			
            $payload = $request->except(['function']);

            $explode = explode("::", $function);
            $function = $explode[1];

           $segment = ScreenSegments::where("id", $explode[0])->first();
		   
          $class = ($segment) ? $segment->getModel() : false;


            if(class_exists($class)) {
                $c = new $class();
            } else exit("Non-existing class");

            if ( method_exists ( $c , $function ) ) {
		
                $callback = $c->$function($payload, $segment);

                if($callback===true) {
                    return Redirect::to($slug);
                } else {
                    return redirect()->back()->withInput()
                        ->withErrors($callback);
                }

            } else {
                exit("Method (" . $function . ") not defined in Class");
            }

        }


        // Scenario #2: GET REQUEST

        if($request->isMethod('get'))
        {
            // get Screen
            $user = Auth::user();
            $accessLevel = \App\User::USER_DEFAULT;
            if(isset($user->access->level)) {
                $accessLevel = $user->access->level;
            }

            // TODO: Move to middleware
			if ($accessLevel == \App\User::USER_BANNED) 
				return response()->view('errors.404', [], 404); // user banned
			
            $screen = Screen::where("slug", $slug)
					->where('status', '!=', Screen::SCREEN_DELETED)
					->firstOrFail();

			if (!$screen || $screen->status == Screen::SCREEN_DRAFT
					&& $accessLevel != \App\User::USER_ADMIN) {
				// screen in draft & user not admin, return 404
				return response()->view('errors.404', [], 404);
			}

            // get Request
            $response = \App\ScreenBuilder\HTMLBuilder::renderScreen($slug);
			//echo '<pre>';print_r($response);exit;

            if(isset($response['error'])) {
                return response()->view('errors.404', [], 404);
            } else {
                return view($response['screen']->getTemplate())
                    ->with('htmlBuilt', true)
                    ->with('screen', $screen)
                    ->with('result', $response['result']);
            }
        }


    }

    public function setLanguage()
    {
        // if cookie is set (from the login), read it and discard it
        $cookie = isset($_COOKIE['lang']) ? strtoupper($_COOKIE['lang']) : null;
        setcookie("lang", "", time()-3600, '/');

        // if it's not empty, try to find such language and set it for future for logged in user
        if(!empty($cookie)) {
            $langRow = DB::table("languages")->where('lang', $cookie)->first();
            if($langRow) {
                Auth::user()->selected_lang = $langRow->id;
                Auth::user()->save();
            }
        }

        // if by any miracle lang have value 0 set it to 1
        if(Auth::user()->selected_lang==0) {
            Auth::user()->selected_lang =1;
            Auth::user()->save();
        }

        // use user's lang setting to initiate setLocale
        App::setLocale( Auth::user()->language->lang );

    }


}
