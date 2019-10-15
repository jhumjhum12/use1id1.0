@extends('layouts.app', ['slug'=>'contacts', 'title'=>'' ,'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()])

@section('content')

    <div class="my-data-heading">
        <img class="img-circle" src="{{ $user->getImage() }}" width="120"> <br /><br />
        <h1>{{ $user->first_name }} {{ $user->last_name }} </h1>
    </div>

    <p class="text-center">

            @if($contact==false)
            <a class="btn btn-default" href="{{ route('contacts.invite.get', ['id'=>$user->personal_id]) }}">{{ Label::get('send_invite') }}</a>
            @else

                @if($contact->status===null)
                    <a class="btn btn-default" href="{{ route('contacts.invite.get', ['id'=>$contact->member->personal_id]) }}">{{ Label::get('send_invite') }}</a>
                @endif
                @if($contact->user_1 == Auth::user()->id && $contact->status==0)
                    <a class="btn btn-default disabled" href="javascript:void(0)">{{ Label::get('request_pending') }}</a>
                @endif
                @if($contact->user_2 == Auth::user()->id && $contact->status==0)
                    <a class="btn btn-default" href="{{ route('contacts.accept-invite', ['email'=>$contact->member->email]) }}">{{ Label::get('accept') }}</a>
                @endif
                @if($contact->status==1)
                    <a class="btn btn-primary" href="{{ route('contacts.view.details', $contact->member->id) }}">{{ Label::get('view_profile') }}</a>
                @endif
            @endif



    </p>

@endsection
