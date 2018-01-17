@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">

                        <div class="row profileAvatar-row">
                        <div class="col-xs-12 profileAvatar-col">
                            <div class="profileAvatarBox">
                                <div class="profileAvatar" style="background: url('/uploads/avatars/{{$profile->avatar}}');
                                                                  background-position: center;
                                                                  background-size: cover;">  
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row profileInfo-row">
                            <div class="profileInfo">
                                <ul class="profileInfo-ul">
                                    <li>
                                        <span class="infoTitle-span">
                                        <i class="fa fa-id-card" aria-hidden="true"></i>
                                        Gebruikersnaam:
                                        </span>

                                        <span class="infoData-span">{{$user->username}}</span>
                                    </li>
                                    @if(Auth::user() && Auth::user()->roleID == 2)
                                    <li>
                                        <span class="infoTitle-span">
                                        <i class="fa fa-address-card" aria-hidden="true"></i>
                                        Naam:
                                        </span>

                                        <span class="infoData-span">{{$profile->realName}}</span>
                                    </li>
                                    <li>
                                        <span class="infoTitle-span"><i class="fa fa-address-book" aria-hidden="true"></i>
                                        Email:
                                        </span>

                                        <span class="infoData-span">{{$user->email}}</span>
                                    </li>
                                    @endif
                                    <li>
                                        <span class="infoTitle-span"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                        Aangemeld:
                                        </span>

                                        <span class="infoData-span">{{$user->created_at}}</span>
                                    </li>
                                    <li>
                                        <span class="infoTitle-span"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        Rang:
                                        </span>

                                        <span class="infoData-span">{{$role->role}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>  

                    @if(Auth::user()->id == $user->id || Auth::user()->roleID == 2)
                        @if(Auth::user()->roleID == 3)
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>Deze Gebruiker is gebanned!</strong>
                                    </span>
                                </div>
                        @elseif(Auth::user()->activated == 0)
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>Activeer uw account!</strong>
                                    </span>
                                </div>
                        @else
                        <div class="row profileButton-row">
                           <div class="col-xs-12 profileButton-col">
                            <a href="/profiel/edit/{{$user->id}}" class="btn btn-primary btn-profile-full">
                            <span class="profileButton-span">Bewerk Gebruiker</span>
                            </a>
                           </div>                       
                        </div>
                        @endif
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
