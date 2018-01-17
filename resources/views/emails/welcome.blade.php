<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
	</head>

<body style="height: 500px;
	    	 min-height: 500px;
	    	 width: 100%;
	    	 min-width: 100%;
	    	 color: #60ffff;
	    	 text-align: center;
	    	 background-image: url('https://i.ytimg.com/vi/u5ordO94Wm0/maxresdefault.jpg');
			 background-position: center;
			 background-size: cover;
			 background-attachment: fixed;">
	<div style="width: 100%;
	    		height: 100%;
	    		background: rgba(0, 0, 0, 0.5);">
	    <div style="height: auto;
	    			width: 100%;
	    			background: rgba(239, 130, 143, 0.5);
	    			border-bottom: 5px solid #EF828F;
	    			">
	    	<h1>Welkom op TruisTaartjes {{ $username }}</h1>
	    	<h2>Activeer uw account met deze link!</h2>
	    </div>
		
		<br>
		<br>
		<div style="height: auto;
    				min-height: 150px;
    				">
			<p>
			<a href="http://truistaartjess/user/activation/{{ $activateToken }}" style="font-size: 25px;
																						text-decoration: none;
																						color: #afeeee;
																						text-transform: uppercase;
								    													font-weight: bolder;">
			Activeer mijn Account!
			</a>
			</p>

		    <p>Dit is een Automatische Mail</p>
		</div>
	</div>
</body>
</html>