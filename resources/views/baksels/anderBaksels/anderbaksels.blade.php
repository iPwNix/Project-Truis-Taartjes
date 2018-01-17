@extends('layouts.app')

@section('content')
<div class="container test-container">
    <div class="row post-row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Andere Creaties <a href="/decoraties/maken">Post Maken</a></div>

                <div class="panel-body">
                    @foreach($anderBaksels as $anderBaksel)
                    <a href="/anderecreaties/creatie/{{$anderBaksel->id}}">{{$anderBaksel->title}}</a>
                    <br>
                    Type: {{$anderBaksel->getBakType()}}
                    <br>
                    Status: {{$anderBaksel->getBakStatus()}}
                    <br>
                    Comment Status: {{$anderBaksel->getCommentStatus()}} <br>
                    <img src="/uploads/baksels/{{$anderBaksel->getBakType()}}/{{$anderBaksel->getBakselPhotoOne()}}" style="max-width: 300px; max-height: 300px;">
                    <br><br>
                    @endforeach
                </div>
                    {!! with(new App\Pagination\HDPresenter($anderBaksels))->render(); !!}
            </div>
        </div>
    </div>
</div>
@endsection
