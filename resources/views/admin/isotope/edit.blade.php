@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">
                      <div class="row edituserlist-row">

                        <div class="col-xs-12 slidernumbr-col">
                        <span>Isotope Foto #{{$isoTopeToUpdate->id}} Bijwerken</span>
                        </div>

                        <div class="col-xs-12 quoteimg-col">
                        <img src="/uploads/isotopes/{{$isoTopeToUpdate->imageName}}" alt="">
                        </div>

                    <form class="form-horizontal" 
                          action="/beheer/editgallerij/{{$isoTopeToUpdate->id}}" enctype="multipart/form-data" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}


                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="isoTypeOne">Type #1:</label>
                                  <div class="col-xs-12">

                                    <select class="form-control profileEditForm-control" id="isoTypeOne" name="isoTypeOne">
                                       @foreach($isotopeTypesOne as $isoTopeType)
                                       @if($isoTopeType->id == $isoTopeToUpdate->isoTypeOne)
                                       <option value="{{$isoTopeType->id}}" selected="true">{{$isoTopeType->type}}</option>
                                       @else
                                       <option value="{{$isoTopeType->id}}">{{$isoTopeType->type}}</option>
                                       @endif
                                       @endforeach
                                     </select>

                                    @if ($errors->has('isoTypeOne'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('isoTypeOne') }}</strong>
                                        </span>
                                    </div>
                                    @endif

                                  </div>
                                </div>

                            <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="isoTypeTwo">Type #2:</label>
                                  <div class="col-xs-12">

                                    <select class="form-control profileEditForm-control" id="isoTypeTwo" name="isoTypeTwo">
                                       @foreach($isotopeTypes as $isotopeType)
                                       @if($isotopeType->id == 4 || $isotopeType->id == NULL)
                                       <option value="{{$isotopeType->id}}" selected="true">{{$isotopeType->type}}</option>
                                       @else
                                       <option value="{{$isotopeType->id}}">{{$isotopeType->type}}</option>
                                       @endif
                                       @endforeach
                                     </select>

                                    @if ($errors->has('isoTypeTwo'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('isoTypeTwo') }}</strong>
                                        </span>
                                    </div>
                                    @endif

                                  </div>
                                </div>


                          <div class="form-group row file-upload-row">
                                <label for="image" class="custom-file-upload custom-file-load-cover col-xs-12">
                                <i class="fa fa-cloud-upload"></i> Foto
                                </label>
                                <div class="col-xs-12">
                                    <input type="file" name="image" id="image" 
                                    class="avatarInput" accept=".jpeg, .jpg, .png">
                                </div>

                                    @if ($errors->has('image'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    </div>
                                    @endif

                            </div>




                                  <div class="form-group profileEditFormBtn">
                                    <div class="col-xs-12">
                                      <button type="submit" class="btn btn-primary btn-profile-edit-full">Opslaan</button>
                                    </div>
                                  </div>

                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
