@extends('layouts.app')

@section('content')
<div class="container test-container">
    <div class="row post-row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Taarten <a href="/taarten/maken">Post Maken</a></div>

                <div class="panel-body">
                    @foreach($taarten as $taart)
                    <a href="/taarten/taart/{{$taart->id}}">{{$taart->title}}</a>
                    <br>
                    Type: {{$taart->getBakType()}}
                    <br>
                    Status: {{$taart->getBakStatus()}}
                    <br>
                    Comment Status: {{$taart->getCommentStatus()}} <br>
                    <img src="/uploads/baksels/{{$taart->getBakType()}}/{{$taart->getBakselPhotoOne()}}" style="max-width: 300px; max-height: 300px;">
                    <br><br>
                    @endforeach
                </div>
                    {!! with(new App\Pagination\HDPresenter($taarten))->render(); !!}
            </div>
        </div>
    </div>
</div>
@endsection
