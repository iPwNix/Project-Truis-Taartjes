@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body posts-body">

                        <div class="col-xs-12 slidernumbr-col">
                        <span>Creatie Posten</span>
                        </div>

                    <form class="form-horizontal" 
                          action="/taarten/maken" enctype="multipart/form-data" method="POST">

                        {{ csrf_field() }}

                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="title">Titel:</label>
                                  <div class="col-xs-12">
                                    <input type="text" class="form-control profileEditForm-control" id="title" 
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="Titel"
                                    maxlength="75" required="true">

                                @if ($errors->has('title'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                </div>
                                @endif

                                  </div>
                                </div>


                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="bakType">Bak Type:</label>
                                  <div class="col-xs-12">

                                    <select class="form-control profileEditForm-control" id="bakType" name="bakType">
                                      @foreach($bakTypes as $bakType)
                                        <option value="{{$bakType->id}}">
                                          {{$bakType->type}}
                                        </option>
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

                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="bakStatus">Status:</label>
                                  <div class="col-xs-12">

                                    <select class="form-control profileEditForm-control" id="bakStatus" name="bakStatus">
                                      @foreach($bakStatuses as $bakStatus)
                                        <option value="{{$bakStatus->id}}">
                                          {{$bakStatus->status}}
                                        </option>
                                      @endforeach
                                     </select>

                                    @if ($errors->has('bakStatus'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('bakStatus') }}</strong>
                                        </span>
                                    </div>
                                    @endif

                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="commentStatus">Comments :</label>
                                  <div class="col-xs-12">

                                    <select class="form-control profileEditForm-control" id="commentStatus" name="commentStatus">
                                      @foreach($commentStatuses as $commentStatus)
                                        <option value="{{$commentStatus->id}}">
                                          {{$commentStatus->status}}
                                        </option>
                                      @endforeach
                                     </select>

                                    @if ($errors->has('commentStatus'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('commentStatus') }}</strong>
                                        </span>
                                    </div>
                                    @endif

                                  </div>
                                </div>


                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="timeSpend">Tijd over gedaan:</label>
                                  <div class="col-xs-12">
                                    <input type="text" class="form-control profileEditForm-control" id="timeSpend" 
                                    name="timeSpend"
                                    value="{{ old('timeSpend') }}"
                                    placeholder="Tijd"
                                    maxlength="75">
                                @if ($errors->has('timeSpend'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('timeSpend') }}</strong>
                                    </span>
                                </div>
                                @endif

                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="description">Beschrijving:</label>
                                  <div class="col-xs-10 col-xs-offset-1">

                                    <textarea name="description" id="description" class="text-editor"
                                    value="{{ old('description') }}" required>{{ old('description') }}</textarea>
                                    
                                @if ($errors->has('description'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                </div>
                                @endif

                                  </div>
                                </div>

                        <div class="photo-preview-row row">
                            <img id="photoOne-preview" class="upload-previewimg" src="/uploads/baksels/Taart/defaultCake.jpg" alt="your image"/>
                            <div class="preview-error error-one"><span class='preview-error-text'>Foto is groter dan 10MB</span></div>
                        </div>

                          <div class="form-group row file-upload-row">
                                <label for="photoOne" class="custom-file-upload custom-file-load-cover col-xs-12">
                                <i class="fa fa-cloud-upload"></i> Foto
                                </label>
                                <div class="col-xs-12">
                                    <input type="file" name="photoOne" id="photoOne" 
                                    class="avatarInput" accept=".jpeg, .jpg, .png">
                                </div>
                                    @if ($errors->has('photoOne'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('photoOne') }}</strong>
                                        </span>
                                    </div>
                                    @endif
                            </div>


                            <div class="form-group row">
                              <label class="col-xs-12 profileEditForm-label" for="meerFotos">Meer Fotos?</label>
                              <div class="col-xs-12 morePics-slider">
                                  <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="meerFotos">
                                  <div class="slider round"></div>
                                </label>
                              </div>
                            </div>

                                    @if ($errors->has('photoTwo'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('photoTwo') }}</strong>
                                        </span>
                                    </div>
                                    @endif
                                    @if ($errors->has('photoThree'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('photoThree') }}</strong>
                                        </span>
                                    </div>
                                    @endif
                                    @if ($errors->has('photoFour'))
                                    <div class="col-xs-12 profileEditForm-error-col">
                                        <span class="help-block profileEditForm-error-block">
                                            <strong>{{ $errors->first('photoFour') }}</strong>
                                        </span>
                                    </div>
                                    @endif




                            <div class="custom-Images-Form" style="display: none;">


                              <div class="photo-preview-row row">
                                  <img id="photoTwo-preview" class="upload-previewimg" src="/uploads/baksels/Taart/defaultCake.jpg" alt="your image"/>
                                  <div class="preview-error error-two"><span class='preview-error-text'>Foto is groter dan 10MB</span></div>
                              </div>

                              <div class="form-group row file-upload-row">
                                <label class="custom-file-upload custom-file-load-cover 
                                custom-file-cover-sm col-xs-12" for="photoTwo">
                                Foto #2</label>
                                <div class="col-xs-12">
                                  <input type="file" name="photoTwo" id="photoTwo" accept=".jpeg, .jpg, .jpe, .png">
                                </div>
                              </div>

                              <div class="photo-preview-row row">
                                  <img id="photoThree-preview" class="upload-previewimg" src="/uploads/baksels/Taart/defaultCake.jpg" alt="your image"/>
                                  <div class="preview-error error-three"><span class='preview-error-text'>Foto is groter dan 10MB</span></div>
                              </div>

                              <div class="form-group row file-upload-row">
                                <label class="custom-file-upload custom-file-load-cover 
                                custom-file-cover-sm col-xs-12" for="photoThree">
                                Foto #3</label>
                                <div class="col-xs-12">
                                  <input type="file" name="photoThree" id="photoThree" accept=".jpeg, .jpg, .jpe, .png">
                                </div>
                              </div>

                              <div class="photo-preview-row row">
                                  <img id="photoFour-preview" class="upload-previewimg" src="/uploads/baksels/Taart/defaultCake.jpg" alt="your image"/>
                                  <div class="preview-error error-four"><span class='preview-error-text'>Foto is groter dan 10MB</span></div>
                              </div>

                              <div class="form-group row file-upload-row">
                                <label class="custom-file-upload custom-file-load-cover 
                                custom-file-cover-sm col-xs-12" for="photoFour">
                                Foto #4</label>
                                <div class="col-xs-12">
                                  <input type="file" name="photoFour" id="photoFour" accept=".jpeg, .jpg, .jpe, .png">
                                </div>
                              </div>
                          </div>




                                  <div class="form-group profileEditFormBtn">
                                    <div class="col-xs-12">
                                      <button type="submit" class="btn btn-primary btn-profile-edit-full">Plaatsen</button>
                                    </div>
                                  </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="/js/custom/bakcreateeditor.js"></script>
<script type="text/javascript" src="/js/custom/bakcreatepicpreview.js"></script>
@endsection
