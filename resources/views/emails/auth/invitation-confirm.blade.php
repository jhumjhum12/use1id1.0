@extends('emails.layouts.master')

@section('headline', 'You are invited to 1ID')

@section('content')
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;">Hi,</span>

        <p>Your just sent invitation to {{ $email }} join 1ID.</p>

        @if($txt)
        <p><b>Message:</b> <i>{{ $txt }}</i></p>
        @endif

        <p>Upon successfully registering invitee will be able to start using 1ID.</p>

    </div>
@stop