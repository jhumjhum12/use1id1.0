@extends('layouts.app', ['title'=>$screen->name])

@section('content')

    {!!  $result  !!}

{{--
@if(isset($htmlBuilt) && $htmlBuilt==true && Auth::user()->isAdmin())
<div id="open-in-screen-builder">
@if(App\ScreenBuilder\ScreenFieldsnew::getErrors())
    <ul>
        @foreach(App\ScreenBuilder\ScreenFieldsNew::getErrors() as $e)
            <li><i class="fa fa-exclamation-triangle"></i> {{ $e }}</li>
        @endforeach
    </ul>
@endif
        </div>
    @endif
--}}

@endsection
