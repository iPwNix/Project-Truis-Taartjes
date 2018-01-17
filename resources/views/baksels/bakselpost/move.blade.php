@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body posts-body">

                    <div class="row posts-title-row">
                    <div class="col-xs-2">
                            <a href="{{$linkName}}/bijwerken/{{$baksel->id}}" 
                               class="btn btn-primary btn-circle-edit btn-circle-back">
                              <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                            </a>
                    </div>
                            <div class="col-xs-8 posts-title-col">
                                <h1>{{$baksel->title}} Verplaatsen</h1>
                            </div>
                          <div class="col-xs-2"></div> 
                    </div>

                    <form class="form-horizontal" 
                          action="{{$linkName}}/verplaats/{{$baksel->id}}" enctype="multipart/form-data" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                  
                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="bakType">Creatie Type:</label>
                                  <div class="col-xs-12">

                                    <select class="form-control profileEditForm-control" id="bakType" name="bakType">
                                       @foreach($bakTypes as $bakType)
                                       @if($bakType->id == $baksel->bakTypeID)
                                       @else
                                       <option value="{{$bakType->id}}">{{$bakType->type}}</option>
                                       @endif
                                       @endforeach
                                     </select>

                                    @if ($errors->has('bakType'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('bakType') }}</strong>
                                        </span>
                                    </div>
                                    @endif

                                  </div>
                                </div>



                                  <div class="form-group profileEditFormBtn">
                                    <div class="col-xs-12">
                                      <button type="submit" class="btn btn-primary btn-profile-edit-full">Bijwerken</button>
                                    </div>
                                  </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
