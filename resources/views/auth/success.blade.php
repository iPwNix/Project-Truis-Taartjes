@extends('layouts.app')

@section('content')
<div class="container login-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welkom</div>
                <div class="panel-body">

                <h1>Welkom, {{ $username }}!</h1>
                <h2>Voordat het account gebruikt kunt worden zal deze geactiveerd moeten worden</h2>
                <h3>Hiervoor hebben we u een mail naar {{ $email }} gestuurd!</h3>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
