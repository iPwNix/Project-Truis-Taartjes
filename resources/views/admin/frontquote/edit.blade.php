@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">
                        
                        <div class="row edituserlist-row">

                        <div class="col-xs-12 slidernumbr-col">
                            <span>Frontpage Quote Bijwerken</span>
                        </div>
                        

                        <div class="col-xs-12 quoteimg-col">
                        <img src="/uploads/frontpage/{{$frontQuoteToUpdate->imageName}}" alt="">
                        </div>

                    <form class="form-horizontal" 
                          action="/beheer/editfrontquote" enctype="multipart/form-data" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                          <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="quote">Quote:</label>
                                  <div class="col-xs-12">
                                    <input type="text" class="form-control profileEditForm-control" id="quote" 
                                    name="quote"
                                    placeholder="Quote"
                                    value="{{$frontQuoteToUpdate->quote}}" 
                                    maxlength="75" required="true">


                                @if ($errors->has('quote'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('quote') }}</strong>
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
