@extends('emails.layouts.master')

@section('headline', 'New Registration')

@section('content')
    <div style="text-align: left; color: #1c2742">
        <p><strong>Hi,</strong></p>

        <p>New user has registered!</p>

        <p>{{ $user->first_name }} {{ $user->last_name }}</p>

        
        
    </div>
@stop