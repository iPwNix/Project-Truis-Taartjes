@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">
                       <div class="row edituserlist-row">
                        @foreach($allIsotopes as $isotope)
                            
                            <div class="col-xs-12 slidernumbr-col">
                            <span>Isotope Foto #{{$isotope->id}}</span>
                            </div>
                            <div class="col-xs-12 slider-info-col">
                                <span>Type #1: {{$isotope->getIsoTypeOne()}}</span>
                            </div>
                            @if($isotope->isoTypeTwo != NULL)
                            <div class="col-xs-12 slider-info-col">
                                <span>Type #2: {{$isotope->getIsoTypeTwo()}}</span>
                            </div>
                            @endif

                            <div class="col-xs-12 silderimg-col">
                            <img src="/uploads/isotopes/{{$isotope->imageName}}" alt="" class="beheermenuimg">
                            </div>

                        <a href="/beheer/editgallerij/{{$isotope->id}}" class="btn btn-primary btn-profile-full edituserlist-btn btn-editslider">
                        Foto bijwerken
                        </a>
                        <div class="post-sep"></div>
                        @endforeach
                        
                        {!! with(new App\Pagination\HDPresenter($allIsotopes))->render(); !!}
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
