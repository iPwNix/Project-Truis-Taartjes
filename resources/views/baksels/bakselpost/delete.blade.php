@extends('layouts.app')

@section('content')

<div class="container profile-container delete-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">

                    <div class="row delete-pagerow delete-pagetitlerow">
                        <div class="col-xs-12 slidernumbr-col">
                        <span>Wilt u {{$bakselToDelete->title}} Verwijderen?</span>
                        </div>
                    </div>

                <div class="row delete-pagerow delete-page-formrow">
                    <form class="form-horizontal" 
                          action="{{$linkName}}/verwijderen/{{$bakselToDelete->id}}" enctype="multipart/form-data" method="POST">

                        {{ csrf_field() }}


                                  <div class="form-group profileEditFormBtn">
                                    <div class="col-xs-12">
                                      <button type="submit" class="btn btn-primary btn-profile-edit-full btn-delete-ja">Ja</button>
                                    </div>
                                  </div>

                    </form>

                    <a href="{{$linkName}}/{{$bakselID}}" class="btn btn-primary btn-profile-edit-full btn-delete-nee">Nee</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
