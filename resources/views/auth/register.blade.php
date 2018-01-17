@extends('layouts.app')

@section('content')
<style>
    .g-recaptcha div:first-child{
        width: 100% !important;
    }
    @media screen and (max-width: 370px){
    #rc-imageselect, .g-recaptcha {transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;}
}
</style>

<div class="container register-container">
    <div class="row logregister-row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default logregister-panel">
                <div class="panel-heading logregister-panel-heading">
                <span class="logregister-panel-head">Registratie</span>
                </div>
                <div class="panel-body">

                    @if(Session::has('activationErrorMessage'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                        {{ Session::get('activationErrorMessage') }}
                        </p>
                    @endif

                    <form role="form" method="POST" action="/register">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <!-- <label for="username" class="logregister-label">Gebruikers Naam</label> -->

                                <input id="username" type="text" class="form-control logregister-control" name="username" value="{{ old('username') }}" placeholder="Gebruikers Naam" required autofocus>

                                @if ($errors->has('username'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                </div>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <!-- <label for="name" class="logregister-label">Naam</label> -->

                                <input id="name" type="text" class="form-control logregister-control" name="name" value="{{ old('name') }}" placeholder="Naam" required autofocus>

                                @if ($errors->has('name'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                </div>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!-- <label for="email" class="logregister-label">E-Mail Address</label> -->

                                <input id="email" type="email" class="form-control logregister-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                </div>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!-- <label for="password" class="logregister-label">Wachtwoord</label> -->

                                <input id="password" type="password" class="form-control logregister-control" name="password" placeholder="Wachtwoord" required>

                                @if ($errors->has('password'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                </div>
                                @endif
                        </div>

                        <div class="form-group">
                            <!-- <label for="password-confirm" class="logregister-label">Bevestig Wachtwoord</label> -->

                                <input id="password-confirm" type="password" class="form-control logregister-control" name="password_confirmation" placeholder="Watchwoord Controle" required>
                        </div>

                        <div class="row form-group-row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! app('captcha')->display()!!}

                                    @if ($errors->has('g-recaptcha-response'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>Captcha invullen graag!</strong>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-btnfull btn-logreg">
                                    Registreer
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
