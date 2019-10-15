@extends('layouts.app', ['slug'=>'contacts', 'title'=>'Invite', 'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()])

@section('content')

            <form method="POST" action="{{ route('contacts.invite.post') }}">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Invite someone to join 1iD">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">{{ Label::get('invite') }}</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            <br />
                            <textarea name="message" class="form-control" placeholder="Optional Message"></textarea>
                    </div>
                </div>
            </form>


            @foreach($pending as $contact)
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-5">
                        <i class="fa fa-envelope-o"></i>
                        {{ $contact->email  }}
                    </div>
                    <div class="col-xs-2">
                            {{ Label::get('pending') }}
                    </div>
                    <div class="col-xs-2">

                    </div>
                </div>
            @endforeach

            <hr />

            @foreach($accepted as $contact)
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-5">
                        <i class="fa fa-envelope-o"></i>
                        {{ $contact->email  }}
                    </div>
                    <div class="col-xs-2">
                        <strong class="text-success">{{ Label::get('accepted') }}</strong>
                    </div>
                    <div class="col-xs-2">

                    </div>
                </div>
            @endforeach


@endsection
