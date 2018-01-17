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

            @if(!Auth::guest() && Auth::user()->roleID == 2)
                    <div class="row posts-title-row">

                        <div class="col-xs-2 post-delete-col">
                            <a href="{{$linkName}}/verwijderen/{{$creatie->id}}" 
                               class="btn btn-primary btn-circle-delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </div>
                            <div class="col-xs-8 posts-title-col">
                                <h1>{{$creatie->title}}</h1>
                            </div>

                        <div class="col-xs-2 post-edit-col">
                            <a href="{{$linkName}}/bijwerken/{{$creatie->id}}" 
                               class="btn btn-primary btn-circle-edit">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>

                    </div>
            @else
                    <div class="row posts-title-row">
                            <div class="col-xs-12 posts-title-col">
                                <h1>{{$creatie->title}}</h1>
                            </div>
                    </div>
            @endif

                        <div class="row post-row">
                            <div class="col-xs-12 post-col-status post-col-statusinfo">
                                <span>Status: 
                                    <span style="color: {{$creatie->getBakStatusColor()}} !important;">{{$creatie->getBakStatus()}}
                                    </span>
                                </span>
                            </div>

                            <div class="col-xs-12 post-col-comments post-col-commentsinfo">
                                <span>Comments: 
                                    <span style="color: {{$creatie->getCommentColor()}} !important;">
                                        {{$creatie->getCommentStatus()}}
                                    </span>
                                </span>
                            </div>

                            <div class="col-xs-12 post-col-image">
                                <img src="/uploads/baksels/{{$creatie->getBakType()}}/{{$creatie->getBakselPhotoOne()}}" class="post-image">
                            </div>
                            @if($creatie->getBakselPhotoTwo() != NULL)
                            <div class="col-xs-12 post-col-image">
                                <img src="/uploads/baksels/{{$creatie->getBakType()}}/{{$creatie->getBakselPhotoTwo()}}" class="post-image">
                            </div>
                            @endif

                            @if($creatie->getBakselPhotoThree() != NULL)
                            <div class="col-xs-12 post-col-image">
                                <img src="/uploads/baksels/{{$creatie->getBakType()}}/{{$creatie->getBakselPhotoThree()}}" class="post-image">
                            </div>
                            @endif

                            @if($creatie->getBakselPhotoFour() != NULL)
                            <div class="col-xs-12 post-col-image">
                                <img src="/uploads/baksels/{{$creatie->getBakType()}}/{{$creatie->getBakselPhotoFour()}}" class="post-image">
                            </div>
                            @endif
                        </div>
                        <div class="post-sep"></div>
                        <div class="row post-descript-row">
                            <div class="col-xs-10 post-descript-col">
                                {!! $creatie->description !!}
                            </div>
                        </div>
                    
                    </div>
            </div>
        </div>
    </div>


    <div class="row posts-row">
        <div class="col-xs-12 baksels-col">
            <div class="panel panel-default">
                    <div class="panel-body posts-body"> 

                    <div class="row reactionfield-row">
                        <div class="col-xs-12 reactionfield-col">
                            @if(!Auth::guest())

                            @if(Auth::user()->activated == 0)
                            <h2 class="gottaLogMsg">Activeer uw account om een reactie te plaatsen!</h2>
                            <div class="post-sep"></div>
                            @elseif(Auth::user()->roleID == 3)
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <h2 class="gottaLogMsg">U bent gebanned.</h2>
                                    </span>
                                </div>
                            <div class="post-sep"></div>
                            @elseif($creatie->commentStatusID == 2)
                            <h2 class="gottaLogMsg">Reacies zijn uitgeschakeld!</h2>
                            <div class="post-sep"></div>
                            @else
                            <form class="form-horizontal" 
                                  action="{{$linkName}}/{{$creatie->id}}" method="POST">

                            {{ csrf_field() }}

                                    <div class="form-group row comment-row">
                                      <label class="control-label comment-label" for="comment">Reactie</label>
                                        <!-- <textarea id="comment" class="form-control logregister-control" rows ="5" name="comment" required="true"></textarea> -->
                                        <textarea name="comment" id="comment" class="text-editor" required></textarea>


                                    @if ($errors->has('comment'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block custom-form-errorblock">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    </div>
                                    @endif
                                    </div>


                                      <div class="form-group">
                                        <div class="col-xs-12">
                                          <button type="submit" class="btn btn-primary btn-btnfull btn-logreg" name="postReact">Reactie Plaatsen</button>
                                        </div>
                                      </div>

                        </form>
                        @endif
                    @else
                        <h2 class="gottaLogMsg">Login om een reactie te plaatsen!</h2>
                        <div class="post-sep"></div>
                    @endif
                    </div>
                </div>

                    <div class="row commentsection-row">
                        <div class="col-xs-12 commentsection-col">
                            @foreach($comments as $comment)
                            
                            <div class="row comment-row">
                                <div class="col-xs-12 col-sm-4 comment-avatar-col">
                                    <div class="row comment-avatar-imgrow"><img src="/uploads/avatars/{{$comment->getPosterAvatar()}}" style="width: 150px; height: 150px;"></div>
                                    <div class="row comment-avatar-namerow">
                                    <a href="/profiel/{{$comment->postedBy}}">{{$comment->getPostersName()}}</a>
                                    </div>
                                    <div class="row comment-avatar-editdel">
                                    @if(!Auth::guest())
                                            @if(Auth::user()->roleID == 2 || Auth::user()->id == $comment->postedBy && Auth::user()->roleID != 3)
                                            <div class="row comment-avatar-editdelrow">
                                            <ul class="comment-avatar-editdel-ul">
                                            <li class="comment-avatar-editdel-liedit">
                                            <a href="comments/bijwerken/{{$comment->id}}" class="btn btn-primary btn-circle-edit-comment">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            </li>
                                            @if(Auth::user()->roleID == 2)
                                            <li class="comment-avatar-editdel-lidelete">
                                            <a href="comments/verwijderen/{{$comment->id}}" class="btn btn-primary btn-circle-delete-comment"><i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                            </li>
                                            @endif
                                            </div>
                                            </ul>
                                            @endif
                                        @endif
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-6 comment-content-col"><span>{!!$comment->comment!!}</span>
                                </div>
                            </div>
                                    <div class="row comment-daterow">
                                        <span>{{$comment->created_at}}</span>
                                    </div>

                            <div class="post-sep"></div>
                            @endforeach

                        @if($allCommentsCount > 4)
                        <div class="row allReactionsBtn-row">
                        <button class="btn btn-default allReactionsBtn" type="button" name="getReacts">Alle Reacties</button>
                        </div>
                        @endif
                                

                        </div> 


                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>  

    <div class="col-xs-12">
        <div id="ajaxDiv">
            
        </div>
    </div>
    
    <script type="text/javascript" src="/js/custom/preloader.js"></script>
    <script type="text/javascript" src="/js/custom/commenteditor.js"></script>
    <script>
         $(function() {
            var creatieID = {{$creatie->id}};

        $(".allReactionsBtn").click(function(){
            //alert(creatieID);
             $.ajax({
                 type: "POST",
                 url: "/baksel/getallcomments/"+creatieID,
                 data: {
                        "_token": "{{ csrf_token() }}",
                        "bakselID": creatieID
                        },
                 success: function(data) {
                    var message = data;
                    
                    var arrayLength = data.length;
                    $(".commentsection-col").html("");

                    @if(!Auth::guest())
                    var userID = {{Auth::user()->id}};
                    var userRole = {{Auth::user()->roleID}};
                    //Als de ingelogde gebruiker een admin is word deze ajax opgehaald (Met edit en delete buttons)
                    if(userRole == 2){
                        for(counter = 0; counter < arrayLength; counter++){
                            
                            $(".commentsection-col").append("<div class='row comment-row'><div class='col-xs-12 col-sm-4 comment-avatar-col'><div class='row comment-avatar-imgrow'><img src='/uploads/avatars/"+data[counter].avatar+"' style='width: 150px; height: 150px;'></div><div class='row comment-avatar-namerow'><a href='/profiel/"+data[counter].postedBy+"'>"+data[counter].posterName+"</a></div><div class='row comment-avatar-editdel'>@if(!Auth::guest())<div class='row comment-avatar-editdelrow'><ul class='comment-avatar-editdel-ul'><li class='comment-avatar-editdel-liedit'><a href='comments/bijwerken/"+data[counter].id+"' class='btn btn-primary btn-circle-edit-comment'><i class='fa fa-pencil' aria-hidden='true'></i></a></li>@if(Auth::user()->roleID == 2)<li class='comment-avatar-editdel-lidelete'><a href='comments/verwijderen/"+data[counter].id+"' class='btn btn-primary btn-circle-delete-comment'><i class='fa fa-trash' aria-hidden='true'></i></a></li>@endif</div></ul> @endif</div></div><div class='col-xs-12 col-sm-6 comment-content-col'><span>"+data[counter].comment+"</span></div></div><div class='row comment-daterow'><span>"+data[counter].created_at.date+"</span></div><div class='post-sep'></div>");

                        }
                    }else{
                    //Als de ingelogde gebruiker geen admin is word er over alle comments gelooped en gekeken of de comment van de ingelogde gebruiker is.
                    //Zo ja word de edit button laten zien.
                    for(counter = 0; counter < arrayLength; counter++){

                            $(".commentsection-col").append("<div class='row comment-row'><div class='col-xs-12 col-sm-4 comment-avatar-col'><div class='row comment-avatar-imgrow'><img src='/uploads/avatars/"+data[counter].avatar+"' style='width: 150px; height: 150px;'></div><div class='row comment-avatar-namerow'><a href='/profiel/"+data[counter].postedBy+"'>"+data[counter].posterName+"</a></div><div class='row comment-avatar-editdel'>@if(!Auth::guest())<div class='row comment-avatar-editdelrow'><ul class='comment-avatar-editdel-ul'></div></ul> @endif</div></div><div class='col-xs-12 col-sm-6 comment-content-col'><span>"+data[counter].comment+"</span></div></div><div class='row comment-daterow'><span>"+data[counter].created_at.date+"</span></div><div class='post-sep'></div>");
                        //Als user ID gelijk is aan de postedBy ID en de role niet 3 (Banned) is word de edit button laten zien.
                        if(userID == data[counter].postedBy && userRole != 3){
                                if(userID == data[counter].postedBy){
                                    var toBeAdded = "<li class='comment-avatar-editdel-liedit'><a href='comments/bijwerken/"+data[counter].id+"' class='btn btn-primary btn-circle-edit-comment'><i class='fa fa-pencil' aria-hidden='true'></i></a></li>";

                                    $(".comment-avatar-editdel-ul").last().append(toBeAdded);
                                }
                            } 
                        }
                    }
                    @else
                    for(counter = 0; counter < arrayLength; counter++){
                        $(".commentsection-col").append("<div class='row comment-row'><div class='col-xs-12 col-sm-4 comment-avatar-col'><div class='row comment-avatar-imgrow'><img src='/uploads/avatars/"+data[counter].avatar+"' style='width: 150px; height: 150px;'></div><div class='row comment-avatar-namerow'><a href='/profiel/"+data[counter].postedBy+"'>"+data[counter].posterName+"</a></div><div class='row comment-avatar-editdel'><div class='row comment-avatar-editdelrow'><ul class='comment-avatar-editdel-ul'></div></ul></div></div><div class='col-xs-12 col-sm-6 comment-content-col'><span>"+data[counter].comment+"</span></div></div><div class='row comment-daterow'><span>"+data[counter].created_at.date+"</span></div><div class='post-sep'></div>"); 
                    }


                    @endif
                     //$("#ajaxDiv").append("<div class='row comment-row'>"+data+"</div>");
                },
                error: function(x,a,y){ //add this error function
                     //console.log("Error");
                    //console.log(JSON.stringify(x)+" "+a);
                     $("#ajaxDiv").append("<div>"+JSON.stringify(x)+" "+a+"</div>");
                }
            });
        });

        });
    </script>


@endsection
