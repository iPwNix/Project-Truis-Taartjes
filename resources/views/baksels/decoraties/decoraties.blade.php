@extends('layouts.app')

@section('content')
<div class="container test-container">
    <div class="row post-row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Decoraties <a href="/decoraties/maken">Post Maken</a></div>

                <div class="panel-body">
                    @foreach($decoraties as $decoratie)
                    <a href="/decoraties/decoratie/{{$decoratie->id}}">{{$decoratie->title}}</a>
                    <br>
                    Type: {{$decoratie->getBakType()}}
                    <br>
                    Status: {{$decoratie->getBakStatus()}}
                    <br>
                    Comment Status: {{$decoratie->getCommentStatus()}} <br>
                    <img src="/uploads/baksels/{{$decoratie->getBakType()}}/{{$decoratie->getBakselPhotoOne()}}" style="max-width: 300px; max-height: 300px;">
                    <br><br>
                    @endforeach
                </div>
                    {!! with(new App\Pagination\HDPresenter($decoraties))->render(); !!}
            </div>
        </div>
    </div>
</div>
@endsection
