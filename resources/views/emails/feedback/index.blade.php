@extends('emails.layouts.master')

@section('headline', 'Following feedback has been received!')

@section('content')
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;"></span>

        <p><strong>Feedback was sent from the following user:</strong></p>
        <p><strong>{{ $user->first_name }} {{ $user->last_name }}</strong> <i>({{$user->email}})</i> ID - {{ $user->id }} </p>
            
        <p><strong>Feedback Type:</strong></p>
        <p>{{ $feedback_type }}</p>

        <p><strong>Description:</strong></p>
        <p>{{ $feedback }}</p>
        
        <p><strong>Feedback was sent from the following URL:</strong></p>
        <p><strong>{{ $current_url }}</strong</p>

        <p><strong>Feedback sent on:</strong></p>
        <p>{{ date("d/m/Y H:i:s") }}</p>
        <!-- <p>Learn more about our solution here: <a href="http://use1id.com/1id_solution.html">Our Solution</a><p>
        </p> -->
        

    </div>
@stop