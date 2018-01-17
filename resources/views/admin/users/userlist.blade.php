@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">
                        @foreach($allUsers as $user)
                        <div class="row edituserlist-row">
                            <div class="col-xs-12 col-sm-4 edituserlist-avatar-col">
                                <img src="/uploads/avatars/{{$user->getUserAvatar()}}" alt="" class="edituserlist-avatar">
                            </div>
                            <div class="col-xs-12 col-sm-4 edituserlist-username-col">
                                <span class="edituserlist-username">{{$user->username}}</span>
                            </div>
                            <div class="col-xs-12 col-sm-4 edituserlist-button-col">
                                <a href="/profiel/edit/{{$user->id}}" class="btn btn-primary btn-profile-full edituserlist-btn">Gebruiker Bijwerken</a>
                            </div>
                        </div>
                        <div class="post-sep"></div>
                        @endforeach
                        {!! with(new App\Pagination\HDPresenter($allUsers))->render(); !!}
                	</div>
            </div>
        </div>
    </div>
</div>

@endsection
