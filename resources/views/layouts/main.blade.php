<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="shortcut icon" href="http://bootstrap-3.ru/assets/ico/favicon.ico">

	    <title>@yield('title')</title>
	    
	  	<link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">

	    <!-- Bootstrap core CSS -->


	    <!-- Custom styles for this template -->


	    <!-- Just for debugging purposes. Don't actually copy this line! -->
	    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <style type="text/css">

	    </style>
	</head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="{!!url()!!}">Blog.dev</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="{!!url('/post')!!}">Posts</a></li>
					<li><a href="{!!url('/category')!!}">Categories</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if(Auth::check())
						<li class="dropdown ">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<span class="glyphicon glyphicon-user"></span> {{{Auth::user()->name}}}
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">View Profile</a></li>
								<li><a href="#">View Posts</a></li>
								<li><a href="#">View Categories</a></li>
							</ul>
						</li>
						<li>
							<a href="{!!url('/auth/logout')!!}"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
						</li>
					@else
						<li>
							<a href="{!!url('/auth/register')!!}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
						</li>
						<li>
							<a href="{!!url('/auth/login')!!}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
						</li>
						<li>
							<a href="{!!url('/login/fb')!!}"><span class="glyphicon glyphicon-log-in"></span> Login With facebook</a>
						</li>
					@endif
				</ul>
			</div>
  		</div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    @yield('header')
    

    <div class="container" style="padding-bottom:0; margin-top:15px; ">
		@include('alerts.messages')  
     	 @yield('content')


      	<hr>

      	@include('layouts._footer')
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ url('/js/bootstrap.js') }}"></script>
	
  
</body></html>