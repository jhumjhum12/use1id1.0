@extends('emails.layouts.master')

@section('headline', 'Your email authentication is required')

@section('content')
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;">Hello!</span>

        <p> You are receiving this email because we received a password reset request for your account. </p>

        <p>If you did not request a password reset, no further action is required.</p>

        <table cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" width="350px" height="40" bgcolor="#42566f"
                    style="color: #ffffff; display: block; -o-border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;">
                    <a href="{{ $url }}"
                       style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block;">Click
                        Here for Password Reset</a>
                </td>
            </tr>
        </table>

    </div>
@stop