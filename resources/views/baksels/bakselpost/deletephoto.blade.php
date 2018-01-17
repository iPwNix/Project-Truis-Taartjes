@extends('layouts.app')

@section('content')

<!-- <div class="preload">
    <div class="preload-title">
        <span class="preload-titleOne">Truis <span class="preload-titleTwo">Taartjes</span></span>
    </div>

    <div class="loader-frame">
        <div class="loader1" id="loader1"></div>
        <div class="loader2" id="loader2"></div>
    </div>
</div> -->

<div class="container profile-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">

                    <div class="row delete-pagerow delete-pagetitlerow">
                        <div class="col-xs-2 post-edit-col">
                            <a href="{{$linkName}}/bijwerken/{{$baksel->id}}" 
                               class="btn btn-primary btn-circle-edit btn-circle-back">
                              <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-xs-8 slidernumbr-col">
                        <span>{{$baksel->title}}'s Fotos Verwijderen</span>
                        </div>
                        <div class="col-xs-2"></div>
                    </div>

                        <div class="row edituserlist-row">
                            <div class="col-xs-12 slidernumbr-col">
                            <span>Foto #1</span>
                            </div>

                            <div class="col-xs-12 silderimg-col">
                            <img src="/uploads/baksels/{{$bakselTypeName}}/{{$bakselPhotosToDelete->photoOne}}" alt="Geen Foto">
                            </div>

                            <form action="{{$linkName}}/fotos/verwijderen/{{$bakselID}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="fotoNr" value="photoOne">
                                <div class="col-xs-12 slider-edit-btn">
                                    <button type="submit" class="btn btn-primary btn-profile-full edituserlist-btn btn-editslider">Foto Verwijderen</button>
                                </div> 
                           </form>
                        </div>
                        <div class="post-sep"></div>

                        @if($bakselPhotosToDelete->photoTwo != NULL)
                        <div class="row edituserlist-row">
                            <div class="col-xs-12 slidernumbr-col">
                            <span>Foto #2</span>
                            </div>

                            <div class="col-xs-12 silderimg-col">
                            <img src="/uploads/baksels/{{$bakselTypeName}}/{{$bakselPhotosToDelete->photoTwo}}" alt="Geen Foto">
                            </div>

                            <form action="{{$linkName}}/fotos/verwijderen/{{$bakselID}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="fotoNr" value="photoTwo">
                                <div class="col-xs-12 slider-edit-btn">
                                    <button type="submit" class="btn btn-primary btn-profile-full edituserlist-btn btn-editslider">Foto Verwijderen</button>
                                </div> 
                           </form>
                        </div>
                        <div class="post-sep"></div>
                        @endif

                        @if($bakselPhotosToDelete->photoThree != NULL)
                        <div class="row edituserlist-row">
                            <div class="col-xs-12 slidernumbr-col">
                            <span>Foto #3</span>
                            </div>

                            <div class="col-xs-12 silderimg-col">
                            <img src="/uploads/baksels/{{$bakselTypeName}}/{{$bakselPhotosToDelete->photoThree}}" alt="Geen Foto">
                            </div>

                            <form action="{{$linkName}}/fotos/verwijderen/{{$bakselID}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="fotoNr" value="photoThree">
                                <div class="col-xs-12 slider-edit-btn">
                                    <button type="submit" class="btn btn-primary btn-profile-full edituserlist-btn btn-editslider">Foto Verwijderen</button>
                                </div> 
                           </form>
                        </div>
                        <div class="post-sep"></div>
                        @endif

                        @if($bakselPhotosToDelete->photoFour != NULL)
                        <div class="row edituserlist-row">
                            <div class="col-xs-12 slidernumbr-col">
                            <span>Foto #4</span>
                            </div>

                            <div class="col-xs-12 silderimg-col">
                            <img src="/uploads/baksels/{{$bakselTypeName}}/{{$bakselPhotosToDelete->photoFour}}" alt="Geen Foto">
                            </div>

                             <form action="{{$linkName}}/fotos/verwijderen/{{$bakselID}}" method="POST">
                             {{ csrf_field() }}
                            <input type="hidden" name="fotoNr" value="photoFour">
                                <div class="col-xs-12 slider-edit-btn">
                                    <button type="submit" class="btn btn-primary btn-profile-full edituserlist-btn btn-editslider">Foto Verwijderen</button>
                                </div> 
                           </form>
                        </div>
                        <div class="post-sep"></div>
                        @endif
                	</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/custom/preloader.js"></script>
@endsection
