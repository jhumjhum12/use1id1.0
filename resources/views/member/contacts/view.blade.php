@extends('layouts.app', ['slug'=>'contacts', 'title'=>'View Contacts',  'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()])
@section('content')

    @include('member.contacts.partials.contact-grid')

@endsection
