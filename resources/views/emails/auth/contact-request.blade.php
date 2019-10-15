@extends('emails.layouts.master')

@section('headline', 'You Have Contact Request')

@section('content')
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;">Hi,</span>

        <p>Your just received contact request from
            <strong>{{ $user->first_name }} {{ $user->last_name }}</strong> <i>({{$user->email}})</i>.</p>

        <p>To see your current contacts you can click <a href="{{ route('contacts.view') }}"><strong>HERE</strong></a></p>

    </div>
@stop