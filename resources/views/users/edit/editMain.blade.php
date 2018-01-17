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
                        <li class="profileEditMenu-first-li profileEditMenu-li-active"><a href="/profiel/edit/{{$user->id}}" class="btn btn-primary profileEditMenu-btn profileEditMenu-a-active" disabled="disabled">Avatar Bijwerken</a></li>
                        @endif

                        @if(Auth::user()->roleID == 2)
                        <li class="profileEditMenu-second-li"><a href="/profiel/edit/info/{{$user->id}}" class="btn btn-primary profileEditMenu-btn">Gegevens Bijwerken</a></li>
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

                        <div class="avatar-preview row">
                            <img id="avatar_upload_preview" src="/uploads/avatars/{{$profile->avatar}}" alt="your image"/>
                            <div class="avatar-preview-error"><span class='preview-error-text'>Avatar groter dan 3MB</span></div>
                        </div>

                    <form class="form-horizontal" 
                          action="/profiel/edit/{{ $user->id }}"  
                          enctype="multipart/form-data" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                            <div class="form-group row file-upload-row">
                                <label for="avatar" class="custom-file-upload custom-file-load-cover col-xs-12">
                                <i class="fa fa-cloud-upload"></i> Nieuwe Avatar (300x300px, 3MB Max)
                                </label>
                                <div class="col-md-10">
                                    <input type="file" name="avatar" id="avatar" 
                                    class="avatarInput" accept=".jpeg, .jpg, .png">
                                </div>
                            </div>
                            
                                @if ($errors->has('avatar'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                </div>
                                @endif

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

<script type="text/javascript" src="/js/custom/avatarpreview.js"></script>
@endsection
