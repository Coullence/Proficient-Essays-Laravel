<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Proficient-Essay Order Panel</title>
        <meta name="description" content="">
        <meta name="author" content="Jeremy Kenedy">
        <link rel="shortcut icon" href="/">

        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')

            @if (Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0))
                .user-avatar-nav {
                    background: url({{ Gravatar::get(Auth::user()->email) }}) 50% 50% no-repeat;
                    background-size: auto 100%;
                }
            @endif
            .analysis .card{
	padding: 10px;
	margin: 10px;
	text-align: center;
	z-index: 2px;
	background-color:  #6cb2eb;
}
.analysis a{
	color: white !important;
	font-size: 33px !important;
}
.analysis .card .h4{
	color: white;
	font-family: sans-serif;
}
label{
	color: blue;
}
table{
	border: 1px solid skyblue;
	padding: 5px;
}
td{
	margin: 5px;
	padding: 5px;
}
.blue{
	color: blue !important;
	font-family: sans-serif !important;
	font-weight: 600 !important;
}
.widget{
	border: 0.1px dotted grey;
	padding: 5px;


}
.green{
	font-size: 16px !important;
	font-weight: 600 !important;
	font-family: sans-serif;
	color: #00FF23 !important;
}
.code{
	font-size: 16px !important;
	font-weight: 600 !important;
	font-family: sans-serif;
	color: deeppink !important;
	border: 1px solid #00FF23;
	border-radius: 3px;
	padding: 5px;
	background-color: white;

}

        </style>

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        @if (Auth::User() && (Auth::User()->profile) && $theme->link != null && $theme->link != 'null')
            <link rel="stylesheet" type="text/css" href="{{ $theme->link }}">
        @endif

        @yield('head')

    </head>
    <body>
        <div id="app">

            @include('partials.nav')

            <main class="py-4">

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            @include('partials.form-status')
                        </div>
                    </div>
                </div>

                @yield('content')

            </main>

        </div>

        <!--{{-- Scripts --}}-->
        <!--<script src="{{ mix('/js/app.js') }}"></script>-->
        
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


        @if(config('settings.googleMapsAPIStatus'))
            {!! HTML::script('//maps.googleapis.com/maps/api/js?key='.config("settings.googleMapsAPIKey").'&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
        @endif

        @yield('footer_scripts')
        
        <!--Tawk to add-->
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5eff073e9e5f69442291cb9a/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

    </body>
</html>
