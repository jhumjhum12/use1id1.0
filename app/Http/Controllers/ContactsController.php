<?php

namespace App\Http\Controllers;

use App;
use Mail;
use DB;
use URL;
use Notification;
use Route;
use Session;
use GuzzleHttp;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\HTMLBuilder as HTMLBuilder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Google_Client;

class ContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Route::currentRouteName()!="contacts.view.details")
        {
            $this->middleware('auth');
        }
    }

    public function getView()
    {
        $contacts = App\Contacts::forUser(Auth::user()->id)->get();

        return view("member.contacts.view")
            ->with('contacts', $contacts);
    }

    public function getCompaniesView()
    {
        $ids = App\Models\CompanyUser::where('user_id', Auth::user()->id)->where('status', 1)->get()->pluck('company_id')->toArray();
        $companies = App\Models\Company::whereIn('id', $ids )->get();

        return view("member.companies.view")
            ->with('companies', $companies);
    }

    public function getRequests()
    {
        $contacts = App\Contacts::forUser(Auth::user()->id)->get();
        return view("member.contacts.requests")
            ->with('contacts', $contacts);
    }

    public function getInvite()
    {
        $pending = DB::table("invitations")->where("inviter_id", Auth::user()->id)->orderBy('id', 'desc')->where('status', 0)->get();
        $accepted = DB::table("invitations")->where("inviter_id", Auth::user()->id)->orderBy('id', 'desc')->where('status', 1)->get();

        return view("member.contacts.invite")
            ->with('pending', $pending)
            ->with('accepted', $accepted);
    }

    public function getSearch()
    {
        $string = Input::get("search");
        $contacts = [];

        if(isset($string)) {
            $contacts = App\User::
                where(function ($query) use ($string) {
                $query->where("first_name", 'LIKE', "%$string%")
                    ->orWhere("last_name", 'LIKE', "%$string%")
                    ->orWhere("email", 'LIKE', "%$string%");
                    })
                ->where("id", "!=", Auth::user()->id)
                ->get()->take(100);
        };


        $output = [];
        foreach($contacts as $key=>$contact) {
            $output[$key] = new \stdClass();
            $existing = App\Contacts::mutualConnection($contact->id)->first();
            if($existing) {
                $output[$key]->status = $existing->status;
                $output[$key]->status_txt = $existing->getStatus();
                $output[$key]->user_1 = $existing->user_1;
                $output[$key]->user_2 = $existing->user_2;
            } else {
                $output[$key]->status = null;
                $output[$key]->status_txt = null;
                $output[$key]->user_1 = null;
                $output[$key]->user_2 = null;
            }
            $output[$key]->member = $contact;
        }

        return view("member.contacts.search")
            ->with('searchString', $string)
            ->with('contacts', $output);
    }


    public function getSearchCompanies()
    {
        $string = Input::get("search");
        $companies = [];
        if(isset($string)) {
            $companies = App\Models\Company::
                where(function ($query) use ($string) {
                $query->where("name", 'LIKE', "%$string%")
                    ->orWhere("website", 'LIKE', "%$string%");
                    })
                ->orderBy("id", "desc")
                ->get()->take(100);
        };

        return view("member.companies.search-companies")
            ->with('searchString', $string)
            ->with('companies', $companies);

    }

    public function getContactDetails($id)
    {

        // check if we are actually contacts
        $contact = App\Contacts::getContact($id);

//      start insert DV0002 TEST
//      $message = $contact;
//      echo "<script type='text/javascript'>alert('$message');</script>";
//      end insert DV0002 TEST

        if(!Auth::check()) {
            $user = User::where('id', $id)->first();
            if(!$user) {
                $user = User::where('personal_id', $id)->firstOrFail();
            }
            return view("member.contacts.details-outside")
                ->with('user', $user);
        }
        else if($contact || $id==Auth::user()->id) {
            $user = User::where('id', $id)
                ->with('workExperience')
                ->with('projects')
                ->with('education')
                ->with('contactInfo')
				 ->with('spokenLanguages')
                ->firstOrFail();

            $share = [];
            $shareInverted = [];
            $myOwn = true;

            if($user->id != Auth::user()->id) {
                $share = $contact->getShare();
                $myOwn = false;
                $shareInverted = $contact->getShareInverted();
            }

            return view("member.contacts.details")
                ->with('contact', $contact)
                ->with('options', App\Contacts::sharingOptions())
                ->with('myOwn', $myOwn)
                ->with('share', $share)
                ->with('shareInverted', $shareInverted)
                ->with('user', $user);

        } else {
            $contact = App\Contacts::getContactWithStatus($id);
            $user = User::where('id', $id)->first();
            if(!$user) {
                $user = User::where('personal_id', $id)->firstOrFail();
            }
            return view("member.contacts.details-limited")
                ->with('contact', $contact)
                ->with('user', $user);

        }

        // get user model

        // show


    }

    public function acceptInvite($email)
    {

        $user = App\User::where("email", $email)->firstOrFail();
        if(isset($user->id) && $user->id == Auth::user()->id) return false;
//        $relation = DB::table('UD_CC_UID')->where("user_1", $user->id)->first();    //  DV0001    
        $relation = DB::table('contacts')->where("user_1", $user->id)->first();   // DV0001
        if($relation) {
            DB::table('contacts')
                ->where("user_1", $user->id)
                ->where("user_2", Auth::user()->id)
                ->where("status", 0)
                ->update(['status'=>1]);
            Notification::success("Contact Accepted");
        }
        return Redirect::route('contacts.view');
    }


    public function sendInvitation($email, $txt="")
    {
        // scenarios:
        // 1) boarder 1id user (populate contacts)
        // 2) non-boarded 1id user (populate contacts, send notification)
        // 3) isn't 1id user (populate contacts, populate users, send notification)

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$email) exit("no email provided");
        $user = App\User::where("email", $email)->first();
        $message = "";

        if($user && ($user->id == Auth::user()->id)) {
            return false;
        }

        if(!$user) {
            $code = uniqid();
            // check if already invited to prevent spamming
//            $invitation = DB::table('UD_CC_INVITATIONS')->where("inviter_id", Auth::user()->id)->where('email', $email)->first();  //  DV0001         
            $invitation = DB::table('invitations')->where("inviter_id", Auth::user()->id)->where('email', $email)->first();  // DV0001
            if(!$invitation) {
//                DB::table('UD_CC_INVITATIONS')->insert(['inviter_id'=>Auth::user()->id, 'email'=>$email, 'code'=>$code, 'status'=>0]);   // DV0001             
                DB::table('invitations')->insert(['inviter_id'=>Auth::user()->id, 'email'=>$email, 'code'=>$code, 'status'=>0]);  // DV0001
                $this->sendEmailInvite($email, $code, $txt);
                $this->sendEmailInviteConfirm($email, $txt);
                $message = "Invitation sent";
            } else {
                $message = "Invitation already sent";
            }
        }
        else {
            if(App\Contacts::isPendingOrApproved($user->id)) {
                $message = "Already connected";
            } else {
                App\Contacts::create(['user_1'=>Auth::user()->id, "user_2"=>$user->id, "status"=>0]);
                $message = "Request sent";

                $this->sendEmailNotification($email);
            }
        }
        if(!empty($message)) Notification::success($message);
        return true;
    }

    public function sendInvitationPost()
    {
        $email = Input::get("email");
        $message = Input::get("message");
        $invSuccess = $this->sendInvitation($email, $message);
        return Redirect::back();
    }

    public function sendInvitationGet()
    {

        $pid = Input::get("id");
        $user = App\User::where("personal_id", $pid)->first();
        if($user) {
            $invSuccess = $this->sendInvitation($user->email);
            return Redirect::back();
        }

    }



    public function sendEmailInvite($to, $code, $txt="")
    {
        $user = Auth::user();
        Mail::send('emails.auth.invitation', ['user' => $user, 'txt' => $txt, 'code' => $code, 'email'=>$to], function ($m) use ($to) {
            $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
            $m->to($to)->subject('You are invited to 1ID: Global User ID & Company ID');
        });

    }

    public function sendEmailInviteConfirm($receiver, $txt="")
    {
        $user = Auth::user();
        Mail::send('emails.auth.invitation-confirm', ['user' => $user, 'txt' => $txt, 'email'=>$receiver], function ($m) {
            $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
            $m->to(Auth::user()->email)->subject('1ID: Invitation Sent');
        });

    }

    public function sendEmailNotification($to)
    {
        $user = Auth::user();
        Mail::send('emails.auth.contact-request', ['user' => $user, 'email'=>$to], function ($m) use ($to) {
            $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
            $m->to($to)->subject('1ID: Contact Request');
        });

    }

    public function test()
    {
        //$this->sendEmailInvite("februarski@gmail.com", "xxx");
        //echo "OK!";
        //$this->sendEmailInvite("februarski@gmail.com", "XXXXX");
        //$user = Auth::user();
        //return view("emails.auth.invitation", ['user'=>$user]);

    }

    public static function getViewSubmenu()
    {
        return [
            "View" => route('contacts.view'),
            "Search Users" => route('contacts.search'),
            "Invite" => route('contacts.invite'),
            "My Data" => route('contacts.view.details', ['id'=>Auth::user()->id] ),
        ];
    }

    public static function getCompaniesSubmenu()
    {
        return [
            "View Companies" => route('companies.view'),
            "Search Companies" => route('contacts.companies.search'),
            "My Companies" => URL::to('companies' ),
        ];
    }

    public function contactCompanyPost($id)
    {
        $user = Auth::user();
        $type = Input::get("type");
        if($type!="customer" && $type!="employee" ) {
            Notification::error("Bad request");
            return Redirect::back();
        }
        $existing = App\Models\CompanyUser::
                            where("user_id", $user->id)
                            ->where("company_id", $id)
                            ->where('type', $type)
                            ->first();
        if($existing) {
            $existing->delete();
            Notification::error("Connection Removed");
            return Redirect::back();
        } else {

            $company = App\Models\Company::where('id', $id)->first();
            if(!$company) {
                Notification::error("Company not found");
                return Redirect::back();
            }
            $connection = new App\Models\CompanyUser();
            $connection->user_id = Auth::user()->id;
            $connection->company_id = $company->id;
            $connection->status = 1;
            $connection->type = $type;
            $connection->save();
        }

        Notification::success("Connected");
        return Redirect::back();

    }

    public function updateSharing($id)
    {
        $contact = App\Contacts::getContact($id);
        if(!$contact) exit();

        $key = "";
        if($contact->user_1 == Auth::user()->id) { $key="user_1_shares"; }
        if($contact->user_2 == Auth::user()->id) { $key="user_2_shares"; }

        $shareData = json_encode(Input::get('share'));
        $contact->{$key} = $shareData;
        $contact->save();

        Notification::success("Sharing details updated");
        return Redirect::back();

    }

    public function googleAuth()
    {

        $redirect_uri = route('google.auth');
        $jsonFile = 'config/client_secret_355600325504-4268gtkkvlv60rl7cgid1thahcrc2uj0.apps.googleusercontent.com.json';
        $scope = "https://www.google.com/m8/feeds/";
        // $refresh = "1/XSMXV0I5EPPx1JcPt0o1Y5VmbJfh9HipFpB4kkITYxs";
        $refresh = Auth::user()->refresh_token;

        $client = new Google_Client();
        $client->setAuthConfigFile($jsonFile);
        $client->setRedirectUri($redirect_uri);
        $client->addScope($scope);

        if (! isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            $auth_url = str_replace("access_type=online", "access_type=offline", $auth_url);
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            exit();

        } else {

            if(Auth::user()->refresh_token) {
                $client->fetchAccessTokenWithRefreshToken($refresh);
            }
            $client->authenticate($_GET['code']);

            Session::set('access_token', $client->getAccessToken()["access_token"]);
            if($client->getRefreshToken()) {
                Session::set('refresh_token', $client->getRefreshToken());
                Auth::user()->refresh_token = $client->getRefreshToken();
                Auth::user()->save();
            }

            return Redirect::route('google.update', ['authpass'=>1]);
            // $redirect_uri = 'http://localhost/google/';
            // header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

    }

    public function googleAddContactTest()
    {

        $xml = file_get_contents('config/googleContact.xml');

        if (isset($_GET['authpass'])) {

            $url = "https://www.google.com/m8/feeds/contacts/default/full?access_token=" . Session::get('access_token');

            $headers = array(
                'authorization: Bearer ' . Session::get('access_token'),
                'Content-Type: application/atom+xml',
                'GData-Version: 3.0'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


            $data = curl_exec($ch);
            echo "<pre>"; var_dump($data); echo "</pre>";
            if(curl_errno($ch))
                print curl_error($ch);
            else
                curl_close($ch);
            return true;

        } else {
            return Redirect::route('google.auth');
        }


    }

    public function googleUpdateContact()
    {

        if(Input::get('back')) {
            Session::set("after_google", Input::get('back'));
        }

        $xml = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gd="http://schemas.google.com/g/2005">
  <gd:name>
    <gd:fullName>' . Auth::user()->first_name . ' ' . Auth::user()->last_name .  '</gd:fullName>
  </gd:name>
  <!-- ... -->
  <gd:structuredPostalAddress rel="http://schemas.google.com/g/2005#work" primary="true">
    <gd:formattedAddress>' . Auth::user()->getFullAddress() . '</gd:formattedAddress>
  </gd:structuredPostalAddress>
  <!-- ... -->
  <gd:phoneNumber rel="http://schemas.google.com/g/2005#home">
    '. Auth::user()->getFirstPhone() . '
  </gd:phoneNumber>
  <gContact:groupMembershipInfo deleted="false"
href="http://www.google.com/m8/feeds/groups/use1id.dev%40gmail.com/base/6"/>
</entry>';

        if (true) {

            $jsonFile = 'config/client_secret_355600325504-4268gtkkvlv60rl7cgid1thahcrc2uj0.apps.googleusercontent.com.json';

            $client = new Google_Client();
            $client->setAuthConfigFile($jsonFile);
            $data = $client->fetchAccessTokenWithRefreshToken(Auth::user()->refresh_token);
            $client->authenticate($data['access_token']);

            Session::set('access_token', $client->getAccessToken()["access_token"]);



            $elvisID = "http://www.google.com/m8/feeds/contacts/use1id.dev%40gmail.com/base/3f14a420c1ee13e";

            $guzzle = new GuzzleHttp\Client();
            $urlG = 'https://www.google.com/m8/feeds/groups/default/full/49a96a4b8931e304';
            $urlC = 'https://www.google.com/m8/feeds/contacts/use1id.dev@gmail.com/full/';

            try {
                $results = $guzzle->request('PUT',
                    "https://www.google.com/m8/feeds/contacts/default/full/5bfc70fe8b0204f1?alt=json&access_token=" . Session::get('access_token'),
                    [

                        'body' => $xml,
                        'headers' => ['Authorization' => 'Bearer ' . Session::get('access_token'),
                            'GData-Version' => '3.0', 'Content-Type' => 'application/atom+xml', 'If-Match' => '*']

                    ]);
            } catch (Exception $e) {
                //echo '<pre>';
                //var_dump((string)$e->getResponse()->getBody());
            }
            //echo "<pre>";
            //var_dump($results->getStatusCode());
            //var_dump((string)$results->getBody());
            return Redirect::to(Session::get("after_google"));
         //   return Redirect::to('general-data');
        } else {
            return Redirect::route('google.auth');
        }
    }


	public function googleContacts(Request $request)
	{

        $refresh = "1/LUSgTgi5LGMg516gKNmRJEJVkRTFy2p4TEktdsjOrhc";
		$code = $request->get('code');

		// get google service
		$googleService = \OAuth::consumer('Google');

		// check if code is valid

		// if code is provided get user data and sign in
		if ( ! is_null($code)) {
			// This was a callback request from google, get the token

			$token = $googleService->requestAccessToken($code);
			// echo '<pre>';var_dump($token);exit();
			// Send a request with it
			$result = json_decode($googleService->request('https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=400'), true);

			// Going through the array to clear it and create a new clean array with only the email addresses
			$emails = []; // initialize the new array
			$contacts = [];
			foreach ($result['feed']['entry'] as $contact) {
				if (isset($contact['gd$email'])) { // Sometimes, a contact doesn't have email address
					$emails[] = $contact['gd$email'][0]['address'];
					
				}
				$contacts[] = $contact;
			}
			echo '<pre>';var_dump($contacts);exit();
			return $contacts;

		}

		// if not ask for permission first
		else {
			// get googleService authorization
			$url = str_replace('access_type=online', 'access_type=offline', (string)$googleService->getAuthorizationUri());
			//var_dump($url);exit();
			// return to google login url
			return redirect((string)$url);
		}
	}

}
