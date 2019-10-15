@extends('layouts.app-original', ['class'=>'login-page'])

@section('content')

<div class="login-form">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <div class="login-logo">
            <p class="text-center">
                <img height="38" src="{{ URL::asset('img/1id.jpg') }}" />
            </p>
        </div>
        <div class="form-group form-group-login">
            <div class="login-inline inline-label">
                <label for="language" class="control-label">{{ \App\Label::get("language") }}</label>
            </div>
            <div class="login-inline inline-field">

                <select id="language" name="language" class="form-control form-language">
                    <option value="" selected>Profile Language</option>
                    <option value="en">English</option>
                    <option value="nl">Dutch</option>
                    <option value="fr">French</option>
                    <option value="de">Deutsch</option>
                    <option value="sr">Serbian</option>
                </select>

                
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group-login">
            <div class="login-inline inline-label">
                <label for="email" class="control-label">{{ \App\Label::get("email") }}</label>
            </div>
            <div class="login-inline inline-field">

              
					<input id="email" type="email" class="form-control form-input" name="email" value="{{Cookie::get('useremail')}}" required autofocus>
				

                @if ($errors->has('email'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} form-group-login">
            <div class="login-inline inline-label">
                <label for="password" class="control-label">{{ \App\Label::get("password") }}</label>
            </div>
                <div class="login-inline inline-field">
                    <input id="password" type="password" class="form-control form-input" name="password" value="{{Cookie::get('password')}}" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
        </div>

        <div class="form-group form-group-login">
            <button id="login-btn" type="submit" class="btn btn-primary btn-block">
                {{ \App\Label::get("login") }}
            </button>
        </div>

        <div class="form-group form-group-login">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ Cookie::get('test') ? 'checked' : '' }}> {{ \App\Label::get("remember_me") }}
                </label>
            </div>
        </div>

    </form>

    <div class="text-center login-actions">
        <p><a href="{{ url('/password/reset') }}">
                {{ \App\Label::get("forgot_password") }}
        </a></p>
        <p>{{ \App\Label::get("dont_have_account_yet") }} <a href="{{ url('/register') }}">{{ \App\Label::get("click_to_register") }}</a></p>
    </div>

</div>

<script>
        
document.getElementById("login-btn").onclick = function(e){
    createCookie('help',1);
}
</script>

@endsection
