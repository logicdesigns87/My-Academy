<!--Template-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MY Academy</title>
	
    <!-- css -->


    <link href="{{asset('css1/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('font-awesome1/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css1/nivo-lightbox.css')}}" rel="stylesheet" />
	<link href="{{asset('css1/nivo-lightbox-theme/default/default.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css1/owl.carousel.css')}}" rel="stylesheet" media="screen" />
    <link href="{{asset('css1/owl.theme.css')}}" rel="stylesheet" media="screen" />
	<link href="{{asset('css1/animate.css')}}" rel="stylesheet" />
    <link href="{{asset('css1/mobile.css')}}" rel="stylesheet">
	<!-- boxed bg -->
	<!-- template skin -->
	<link id="t-colors" href="{{asset('color1/default.css')}}" rel="stylesheet">
	
	<link rel="stylesheet" href="{{asset('css1/simplemde.min.css')}}">
    <link href="{{asset('css1/style.css')}}" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

<div id="wrapper">
    
    <div id="page-wrap">
        <div class="alert-messages">
          @include('includes.partials.messages')
        </div>
                        @include('includes.partials.logged-in-as')
                        


    </div> 
        @include('frontend.includes.header')	

<!--Content-->	

@yield('content')


<!--Footer-->
@include('frontend.includes.footer') 
<!--Header-->	
   
	<!-- Core JavaScript Files -->
	
    <script src="{{ asset('js1/jquery.min.js') }}"></script>
    <script src="{{ asset('js1/jquery.scrollTo.js') }}"></script>
	<script src="{{ asset('js1/jquery.appear.js') }}"></script>
	<!--<script src="{{ asset('js1/vendor/jquery.easing.min.js') }}"></script>-->

	        <!--<script src="{{ asset('js1/bootstrap.min.js') }}"></script>-->

	<script src="{{ asset('js1/wow.min.js') }}"></script>
	<script src="{{ asset('js1/stellar.js') }}"></script>
	<script src="{{ asset('js1/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js1/nivo-lightbox.min.js') }}"></script>
    <script src="{{ asset('js1/simplemde.min.js') }}"></script>
    <script src="{{ asset('js1/custom.js') }}"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://cdn.omise.co/omise.js"></script>
    <script>
        Omise.setPublicKey("{{config('services.omise.key')}}");
    </script>
	<script src="{{ asset('js1/vendor/Video.js') }}"></script>
    <script src="{{ asset('js1/vendor/Youtube.js')}}"></script>
    <script src="{{ asset('js1/vendor/Vimeo.js') }}"></script> 
    <script src="{{ asset('js1/frontend.js') }}"></script>

        @yield('after-scripts')
</body>

</html>

