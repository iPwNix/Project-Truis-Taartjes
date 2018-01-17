 $(function() {

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
                    //console.log("Success");
                    //console.log(data);
                    //console.log(data.length);
                    //console.debug(message);
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