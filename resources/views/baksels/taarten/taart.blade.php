@extends('layouts.app')

@section('content')

<div class="container test-container">

    <div class="row post-row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{$taart->title}}
                @if(!Auth::guest() && Auth::user()->roleID == 2)
                <a href="/taarten/taart/bijwerken/{{$taart->id}}">Bijwerken</a><br>
                <a href="/taarten/taart/verwijderen/{{$taart->id}}">Verwijderen</a>
                @endif
                </div>
                    <div class="panel-body">
                     <h2>{{$taart->title}}</h2>
                    <br>
                    Type: {{$taart->getBakType()}}
                    <br>
                    Status: {{$taart->getBakStatus()}}
                    <br>
                    Comment Status: {{$taart->getCommentStatus()}} <br>
                    <img src="/uploads/baksels/{{$taart->getBakType()}}/{{$taart->getBakselPhotoOne()}}" style="width: 100%; height: auto;">
                    @if($taart->getBakselPhotoTwo() != NULL)
                    <img src="/uploads/baksels/{{$taart->getBakType()}}/{{$taart->getBakselPhotoTwo()}}" style="width: 100%; height: auto;">
                    @endif
                    @if($taart->getBakselPhotoThree() != NULL)
                    <img src="/uploads/baksels/{{$taart->getBakType()}}/{{$taart->getBakselPhotoThree()}}" style="width: 100%; height: auto;">
                    @endif
                    @if($taart->getBakselPhotoFour() != NULL)
                    <img src="/uploads/baksels/{{$taart->getBakType()}}/{{$taart->getBakselPhotoFour()}}" style="width: 100%; height: auto;">
                    @endif
                    <br>
                    <br>
                    {{$taart->description}}
                    </div>
            </div>
        </div>
    </div>


    <div class="row post-row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                    <div class="panel-body">
                @if(!Auth::guest())
                    @if(Auth::user()->activated == 0)
                    <h2>Activeer uw account om een reactie te plaatsen!</h2>
                    @else
                    <form class="form-horizontal" 
                          action="/taarten/taart/{{$taart->id}}" method="POST">

                        {{ csrf_field() }}

                                <div class="form-group row">
                                  <label class="control-label col-sm-2" for="comment">Comment</label>
                                  <div class="col-sm-10">
                                    <textarea id="comment" class="form-control" rows ="5" name="comment" required="true"></textarea>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif


                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-default">Submit</button>
                                    </div>
                                  </div>

                    </form>
                    @endif
                @else
                    <h2>Login om een reactie te plaatsen!</h2>
                @endif
                    <div class="row">
                        <div class="col-xs-12">
                            @foreach($comments as $comment)
                                <img src="/uploads/avatars/{{$comment->getPosterAvatar()}}" style="width: 150px; height: 150px;"><br>
                                COMMENTID: {{$comment->id}} <br>
                                COMMENT: {{$comment->comment}} <br>
                                POSTEDBY: <a href="/profiel/{{$comment->postedBy}}">{{$comment->getPostersName()}}</a> <br>
                                @if(!Auth::guest())
                                    @if(Auth::user()->roleID == 2 || Auth::user()->id == $comment->postedBy)
                                    <a href="comments/bijwerken/{{$comment->id}}">Edit</a>
                                    <a href="comments/verwijderen/{{$comment->id}}">Delete</a>
                                    <hr>
                                    @endif
                                @endif
                            @endforeach
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection
