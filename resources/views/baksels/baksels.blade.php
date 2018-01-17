@extends('layouts.app')

@section('content')
<div class="preload">
    <div class="preload-title">
        <span class="preload-titleOne">Truis <span class="preload-titleTwo">Taartjes</span></span>
    </div>

    <div class="loader-frame">
        <div class="loader1" id="loader1"></div>
        <div class="loader2" id="loader2"></div>
    </div>
</div>

<div class="container creations-container">
    <div class="row posts-row">
        <div class="col-xs-12 baksels-col">
            <div class="panel panel-default">
                <div class="panel-body posts-body">

                    <div class="row posts-title-row">
                        <div class="col-xs-12 posts-title-col">
                            <h1>{{$titleNameMulti}}</h1>
                        </div>
                    </div>
                @if(!Auth::guest())
                    @if(Auth::user()->roleID == 2)
                    <a href="{{$linkName}}" class="btn btn-primary btn-circle-add">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                    @endif
                @endif

                <div class="row posts-search-row">
                    <div class="col-xs-12 posts-search-col">
                        <div class="post-sep"></div>
                            <form class="form-horizontal" 
                                  action="/{{$titleMultiLower}}" method="GET">

                                    <div class="form-group row zoek-row">
                                        <input name="zoek" id="zoek" class="form-control profileEditForm-control zoek-bar" type="search" placeholder="Wat wilt u zoeken?" autocomplete="off" maxlength="25" required></input>

                                    @if ($errors->has('zoek'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block custom-form-errorblock">
                                            <strong>{{ $errors->first('zoek') }}</strong>
                                        </span>
                                    </div>
                                    @endif
                                    </div>


                                      <div class="form-group">
                                        <div class="col-xs-12">
                                          <button type="submit" class="btn btn-primary btn-btnfull btn-logreg zoek-bar-btn">Zoeken</button>
                                        </div>
                                      </div>

                        </form>
                       <div class="post-sep"></div>
                    </div>
                </div>
                    @if($creaties->count())
                        @foreach($creaties as $creatie)
                        <div class="row post-row">
                            <div class="col-xs-12 post-col-title">
                            <a href="{{$titleLink}}/{{$creatie->id}}" class="post-title-link">
                            {{$creatie->title}}
                            </a>
                            </div>

                            <div class="col-xs-12 post-col-status">
                                <span>Status: 
                                    <span style="color: {{$creatie->getBakStatusColor()}} !important;">{{$creatie->getBakStatus()}}
                                    </span>
                                </span>
                            </div>

                            <div class="col-xs-12 post-col-comments">
                                <span>Comments: 
                                    <span style="color: {{$creatie->getCommentColor()}} !important;">
                                        {{$creatie->getCommentStatus()}}
                                    </span>
                                </span>
                            
                            
                            </div>

                            <div class="col-xs-12 post-col-image">
                                <a href="{{$titleLink}}/{{$creatie->id}}">
                                    <img src="/uploads/baksels/{{$creatie->getBakType()}}/{{$creatie->getBakselPhotoOne()}}" class="posts-image">
                                </a>
                            </div>
                            <hr>
                        </div>
                        <div class="post-sep"></div>
                        @endforeach
                    {!! with(new App\Pagination\HDPresenter($creaties))->render(); !!}
                    @else
                    <h1 class="zoek-error">Niets Gevonden</h1>
                    @endif
                </div>
                    
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/custom/preloader.js"></script>
@endsection
