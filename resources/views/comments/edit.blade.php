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


<div class="container profile-container delete-container">
    <div class="row posts-row">
        <div class="col-xs-12 baksels-col">
            <div class="panel panel-default">
                    <div class="panel-body posts-body">

                        <div class="col-xs-12 slidernumbr-col">
                        <span>Reactie Bijwerken</span>
                        </div>

                    <form class="form-horizontal" 
                          action="{{$linkName}}/comments/bijwerken/{{$commentToUpdate->id}}" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                                <div class="form-group row">
                                  <label class="control-label col-xs-12 profileEditForm-label" for="comment">Comment</label>
                                  <div class="col-xs-12">

                                    <textarea name="comment" id="comment" class="text-editor" required>{{$commentToUpdate->comment}}</textarea>

                                @if ($errors->has('comment'))
                                <div class="col-xs-12 profileEditForm-error-col">
                                    <span class="help-block profileEditForm-error-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
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
    <script type="text/javascript" src="/js/custom/preloader.js"></script>
    <script type="text/javascript" src="/js/custom/commenteditor.js"></script>
@endsection
