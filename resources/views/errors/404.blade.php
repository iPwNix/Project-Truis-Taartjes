@extends('layouts.app')
@section('content')

<div class="container profile-container error-container">
    <div class="row profile-row">
        <div class="col-xs-12 profile-col">
            <div class="panel panel-default">
                <div class="panel-body profile-body">

                <div class="row errorCode-row">
                	<div class="errorCode col-xs-12">
						<h1>404</h1>
					</div>
                </div>

                <div class="row errorMessage-row">
                	<div class="errorMessage col-xs-12">
                		<h2>Niet gevonden</h2>
                	</div>
                </div>

                <div class="row errorLink-row">
                	<div class="errorLink col-xs-12">
                		<a href="/home">Terug</a>
                	</div>
                </div>
				
				</div>
			</div>
		</div>
	</div>
</div>

@endsection