<?php
/**
 * Created by PhpStorm.
 * User: srdjan
 * Date: 10/25/16
 * Time: 15:27
 */


namespace App;

use URL;
use Mail;
use Redirect;
use Input;


class ResetPasswordNotification
{
    public function __construct($token)
    {
        $url = URL::to('password/reset/' . $token);
        $email = Input::get('email');

// DV0001 should be review
        Mail::send('emails.auth.password-reset', ['url' => $url], function ($m) use ($email) {
            $m->from('no-reply@use1id.com', '1ID: Global User ID & Company ID');
            $m->to($email)->subject('1ID Password Reset');
        });


        return redirect('password/reset');

    }

    public static function via()
    {

    }

}