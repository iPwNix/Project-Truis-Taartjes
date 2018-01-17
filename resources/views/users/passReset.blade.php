@extends('layouts.app')

@section('content')
<div class="container forgotpass-container">

    <div class="row logregister-row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default logregister-panel">
                <div class="panel-heading logregister-panel-heading">
                <span class="logregister-panel-head">Wachtwoord Vergeten</span>
                </div>
                <div class="panel-body">

                    @if(Session::has('passResetErrorMsg'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                        {{ Session::get('passResetErrorMsg') }}
                        </p>
                    @endif

                    <form role="form" method="POST" action="/wachtwoordvergeten">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="logregister-label">Email</label>

                                <input id="email" type="text" class="form-control logregister-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-btnfull btn-logreg">
                                    Nieuw Wachtwoord
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
