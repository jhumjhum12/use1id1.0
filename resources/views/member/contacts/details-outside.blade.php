@extends('layouts.app', ['slug'=>'contacts', 'title'=>''])

@section('content')

    <!-- <div class="my-data-heading">
        <img class="img-circle" src="{{ $user->getImage() }}" width="120"> <br /><br />
        <h1>{{ $user->first_name }} {{ $user->last_name }} </h1>
    </div> -->

    @include('member.contacts.partials.basic-data')


    <p class="text-center">

    </p>

@endsection
