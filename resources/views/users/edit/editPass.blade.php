@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">

                        <div class="row profileEditAvatar-row">
                        <div class="col-xs-12 profileAvatar-col">
                            <div class="profileAvatarBox">
                                <div class="profileAvatar" style="background: url('/uploads/avatars/{{$profile->avatar}}');
                                                                  background-position: center;
                                                                  background-size: cover;">  
                                </div>
                            </div>
                        </div>
                        </div>

                <div class="row profileEditMenu-row">
                <div class="col-xs-12 profileEditMenu-col">

                    <ul class="profileEditMenu-ul">
                        @if(Auth::user()->id == $user->id || Auth::user()->roleID == 2)
                          <li class="profileEditMenu-first-li ">
                            <a href="/profiel/edit/{{$user->id}}" class="btn btn-primary profileEditMenu-btn">
                              Avatar Bijwerken
                            </a>
                          </li>
                        @endif

                        @if(Auth::user()->roleID == 2)
                        <li class="profileEditMenu-second-li"><a href="/profiel/edit/info/{{$user->id}}" class="btn btn-primary profileEditMenu-btn">
                        Gegevens Bijwerken</a></li>
                        @endif

                        <li class="profileEditMenu-middle-li">{{$user->username}}</li>

                        @if(Auth::user()->id == $user->id || Auth::user()->roleID == 2)
                        <li class="profileEditMenu-third-li profileEditMenu-li-active"><a href="/profiel/edit/pass/{{$user->id}}" class="btn btn-primary profileEditMenu-btn profileEditMenu-a-active"" disabled="disabled">Wachtwoord Wijzigen</a></li>
                    @endif

                    <li class="profileEditMenu-mobname-li">{{$user->username}}</li>

                    </ul>
                   
                </div>
                </div>


            <div class="row profileEditForm-row">
            <div class="col-xs-12 profileEditForm-col">

                    <form class="form-horizontal" 
                          action="/profiel/edit/pass/{{ $user->id }}"  
                          enctype="multipart/form-data" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}


                            <div class="form-group row">
                                  <label class="control-label profileEditForm-label col-xs-12" for="password">Nieuw Wachtwoord</label>
                                  <div class="col-xs-12">
                                    <input type="password" class="form-control profileEditForm-control" id="password"
                                    name="password" placeholder="Wachtwoord"
                                    maxlength="191" required="true" autocomplete="off">

                                @if ($errors->has('password'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                </div>
                                @endif
                                
                                  </div>
                            </div>

                            <div class="form-group row">
                                  <label class="control-label profileEditForm-label col-xs-12" for="password-confirm">Controle Wachtwoord</label>
                                  <div class="col-xs-12">
                                    <input type="password" class="form-control profileEditForm-control" id="password-confirm"
                                    name="password_confirmation" placeholder="Wachtwoord Controle"
                                    maxlength="191" required="true" autocomplete="off">
                                  </div>
                            </div>







                                  <div class="form-group profileEditFormBtn">
                                    <div class="col-xs-12">
                                      <button type="submit" class="btn btn-primary btn-profile-edit-full">Opslaan</button>
                                    </div>
                                  </div>

                    </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection