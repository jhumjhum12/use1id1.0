@extends('layouts.app-original', ['class' => 'reset-page'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        <img height="38" src="{{ URL::asset('img/1id.jpg') }}" />
                    </p>
                </div>

                <div class="panel-body panel-reset">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email" class="col-md-4 control-label reset-label">E-Mail Address</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control input-reset" name="email" value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="row">
                                <div class="col-md-6">
                                    <label for="password" class="col-md-4 control-label reset-label">Password</label>
                                </div>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control input-reset" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="row">
                                <div class="col-md-6">
                                    <label for="password-confirm" class="col-md-4 control-label reset-label">Confirm Password</label>
                                </div>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control input-reset" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 btn-col">
                                <button type="submit" class="btn btn-primary reset-btn">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
