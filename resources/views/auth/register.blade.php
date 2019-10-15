@extends('layouts.app-original', ['class'=>'register-page'])

@section('content')

<div id="reg-page">
    <div class="register-form">
        <form class="form-horizontal" role="form" method="POST" action="">
             {{ csrf_field() }}
            <div class="login-logo">
                <p class="text-center">
                    <img height="38" src="{{ URL::asset('img/1id.jpg') }}" />
                </p>
                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-group-register">
                        <div class="register-inline">
                            <label for="language" class="control-label">{{ \App\Label::get("language") }}</label>
                        </div>
                        <div class="register-inline">

                            <select id="language" name="selected_lang" class="form-control">
                                <option value="1" selected>English</option>
                                <option value="2">Deutsch</option>
                                <option value="3">Dutch</option>
                                <option value="4">French</option>
                            </select>

                            
                        </div>
                    </div>

                    <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="first-name" class="control-label">{{ \App\Label::get("first_name") }}</label>
                        </div>
                        <div class="register-inline">
                            <input id="first-name" type="text" name="first_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="last-name" class="control-label">{{ \App\Label::get("last_name") }}</label>
                        </div>
                        <div class="register-inline">
                            <input id="last-name" type="text" name="last_name" class="form-control">
                        </div>
                    </div>

                    <div class="register-msg">
                        <p class="msg">Message:</p>

                        <p>Use your first and last name as in your passport ID</p>
                        
                    </div>

                </div>
                <div class="col-md-6">
                     <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-password" class="control-label">{{ \App\Label::get("password") }}</label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-password" type="password" name="password" class="form-control">
                        </div>
                    </div>

                     <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-repeat-password" class="control-label">{{ \App\Label::get("repeat_pass") }}</label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-repeat-password" type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                     <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-reference" class="control-label">{{ \App\Label::get("reference_user") }}</label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-reference" type="text"
                                   disabled="disabled" readonly="readonly"
                                   name="reference_user"
                                   value="@if(isset($inviter)){{ $inviter->first_name }} {{ $inviter->last_name }}@endif"
                                   class="form-control">
                        </div>
                    </div>

                     <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-email" class="control-label">{{ \App\Label::get("email") }}</label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-email" type="email" value="{{ $email }}" name="email" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block reg-btn">{{ \App\Label::get("register") }}</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <span>Already Registered? <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> <a href="{{ url('/login') }}"> {{ \App\Label::get("back_to_login") }}</a></span>
                </div> 
            </div>
        </form>
    </div>
    </div>
@endsection
