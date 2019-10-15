@extends('layouts.app-original', ['class' => 'reset-page'])

<!-- Main Content -->
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
                <div class="panel-body reset-form">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="email" class="col-md-4 control-label email-label">E-Mail Address</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control input-reset-email" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 btn-col">
                                <button type="submit" class="btn btn-primary reset-btn">
                                    Send Password Reset Link
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
