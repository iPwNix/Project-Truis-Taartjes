@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">
                        @foreach($allSliders as $slider)
                        <div class="row edituserlist-row">
                            <div class="col-xs-12 slidernumbr-col">
                            <span>Slider #{{$slider->id}}</span>
                            </div>

                            <div class="col-xs-12 silderimg-col">
                            <img src="/uploads/frontslider/{{$slider->imageName}}" alt="">
                            </div>

                            <div class="col-xs-12 slider-info-col">
                            <span>Titel: {{$slider->sliderTitle}}</span>
                            <span>Beschrijving: {{$slider->sliderCaption}}</span>
                            </div>

                            <div class="col-xs-12 slider-edit-btn">
                                <a href="/beheer/editslider/{{$slider->id}}" class="btn btn-primary btn-profile-full edituserlist-btn btn-editslider">
                                Slider bijwerken
                                </a>
                            </div>
                        </div>
                        <div class="post-sep"></div>
                        @endforeach
                	</div>
            </div>
        </div>
    </div>
</div>

@endsection
