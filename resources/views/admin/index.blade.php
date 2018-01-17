@extends('layouts.app')

@section('content')

<div class="container profile-container delete-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                    <div class="panel-body profile-body">

                    <div class="row delete-pagerow delete-pagetitlerow">
                        <div class="col-xs-12 slidernumbr-col">
                        <span>Beheer</span>
                        </div>
                    </div>

                    <a href="/beheer/gebruikers" class="btn btn-primary btn-beheer-full btnEditUsers">
                        <i class="fa fa-cog" aria-hidden="true"></i> Gebruikers Bijwerken
                    </a>

                    <a href="/beheer/sliders" class="btn btn-primary btn-beheer-full btnEditSliders">
                        <i class="fa fa-cog" aria-hidden="true"></i> Sliders Bijwerken
                    </a>

                    <a href="/beheer/gallerij" class="btn btn-primary btn-beheer-full btnEditIsotope">
                        <i class="fa fa-cog" aria-hidden="true"></i> Gallerij Bijwerken
                    </a>

                    <a href="/beheer/editfrontquote" class="btn btn-primary btn-beheer-full btnEditQuote">
                        <i class="fa fa-cog" aria-hidden="true"></i> Quote Bijwerken
                    </a>

                	</div>
            </div>
        </div>
    </div>
</div>

@endsection
