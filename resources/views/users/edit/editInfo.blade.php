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
                        <li class="profileEditMenu-second-li profileEditMenu-li-active"><a href="/profiel/edit/info/{{$user->id}}" class="btn btn-primary profileEditMenu-btn profileEditMenu-a-active" disabled="disabled">
                        Gegevens Bijwerken</a></li>
                        @endif

                        <li class="profileEditMenu-middle-li">{{$user->username}}</li>

                        @if(Auth::user()->id == $user->id || Auth::user()->roleID == 2)
                        <li class="profileEditMenu-third-li"><a href="/profiel/edit/pass/{{$user->id}}" class="btn btn-primary profileEditMenu-btn">Wachtwoord Wijzigen</a></li>
                    @endif

                    <li class="profileEditMenu-mobname-li">{{$user->username}}</li>

                    </ul>
                   
                </div>
                </div>

            <div class="row profileEditForm-row">
            <div class="col-xs-12 profileEditForm-col">

                    <form class="form-horizontal" 
                          action="/profiel/edit/info/{{ $user->id }}" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}



                                <div class="form-group row">
                                  <label class="control-label profileEditForm-label col-xs-12" for="realName">Naam:</label>
                                  <div class="col-xs-12">
                                    <input type="text" class="form-control profileEditForm-control" id="realName" 
                                    name="realName" value="{{$profile->realName}}" 
                                    placeholder="Vul de echte naam van de gebruiker in"
                                    maxlength="191" required="true" autocomplete="off">

                                @if ($errors->has('realName'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('realName') }}</strong>
                                    </span>
                                </div>
                                @endif

                                  </div>
                                </div>





                                <div class="form-group row">
                                  <label class="control-label profileEditForm-label col-xs-12" for="username">Gebruikersnaam:</label>
                                  <div class="col-xs-12">
                                    <input type="text" class="form-control profileEditForm-control" id="username" 
                                    name="username" value="{{$user->username}}" 
                                    placeholder="Vul de gebruikersnaam in"
                                    maxlength="191" required="true" autocomplete="off">

                                @if ($errors->has('username'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                </div>
                                @endif

                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="control-label profileEditForm-label col-xs-12" for="email">Email:</label>
                                  <div class="col-xs-12">
                                    <input type="email" class="form-control profileEditForm-control" id="email" 
                                    name="email" value="{{$user->email}}" 
                                    placeholder="Vul de gebruiker zijn email in"
                                    maxlength="191" required="true" autocomplete="off">
                                  </div>

                                @if ($errors->has('email'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                </div>
                                @endif

                                @if ($errors->has('emailError'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('emailError') }}</strong>
                                    </span>
                                </div>
                                @endif

                                </div>

                                <div class="form-group row">
                                  <label class="control-label profileEditForm-label col-xs-12" for="role">Rang:</label>
                                  <div class="col-xs-12">
                                  @if($user->id != Auth::user()->id)
                                    <select class="form-control form-control profileEditForm-control" id="role" name="role">
                                      @foreach($roles as $roles)
                                        @if($roles->id == $user->roleID)
                                        <option value="{{$roles->id}}" selected>{{$roles->role}}</option>
                                        @else
                                        <option value="{{$roles->id}}">{{$roles->role}}</option>
                                        @endif
                                      @endforeach
                                     </select>

                                     @else
                                    <select class="form-control form-control profileEditForm-control" id="role" name="role" disabled="disabled">
                                      @foreach($roles as $roles)
                                        @if($roles->id == $user->roleID)
                                        <option value="{{$roles->id}}" selected>{{$roles->role}}</option>
                                        <input type="hidden" name="role" value="{{$roles->id}}" />
                                        @endif
                                      @endforeach
                                     </select>
                                     @endif

                                    @if ($errors->has('role'))
                                      <div class="col-xs-12 profileEditForm-error-col">
                                          <span class="help-block profileEditForm-error-block">
                                              <strong>{{ $errors->first('role') }}</strong>
                                          </span>
                                      </div>
                                    @endif

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
