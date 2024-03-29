@extends('emails.layouts.master')

@section('headline', 'You are invited to 1ID')

@section('content')
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;">Hi,</span>

        <p>Your just received invitation to join 1ID from
            <strong>{{ $user->first_name }} {{ $user->last_name }}</strong> <i>({{$user->email}})</i>.</p>

        @if($txt)
        <p><b>Message:</b> <i>{{ $txt }}</i></p>
        @endif

        <p>With use1ID we want to provide free user solutions so that you keep all this data in 1 location. In return
            we ask the users to work together with us in growing our use1ID community so we can connect to friends and
            companies with 1 user ID.</p>
        <p>

        <p>Learn more about our solution here: <a href="http://use1id.com/1id_solution.html">Our Solution</a>

        <table cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" width="350px" height="40" bgcolor="#f70305"
                    style="color: #ffffff; display: block; -o-border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;">
                    <a href="{{ URL::to('/register?email='. $email . '&code=' . $code) }}"
                       style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block;">Click Here to Activate Your Account</a>
                </td>
            </tr>
        </table>

        <p>Upon successfully registering your account you can start using 1ID.</p>

    </div>
@stop