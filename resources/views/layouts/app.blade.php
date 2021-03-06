<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/my_css.css') }}" rel="stylesheet"> <!-- My CSS Styles -->
	
	
	<!-- Bootsrap -->
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> -->  
	<!-- Bootsrap -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	<!-- Fa Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right black">
					
					    <!-- Common links (make link highlighted )-->
						<li class="{{ Request::is('wpBlogVueFrameWork*') ? 'active' : '' }}"> <a href="{{ route('wpBlogVueFrameWork') }}" > WPress Vue.js + Vuex Store     </a> </li> <!-- NOTE: name vs route -->
						<li class="{{ Request::is('adminStart*') ? 'active' : '' }}">         <a href="{{ route('adminStart') }}" > Vue AdminPart</a></li>
                        <li class="{{ Request::is('getToken*') ? 'active' : '' }}"> <a href="{{ route('getToken') }}" > Get token</a></li>

   
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="{{ Request::is('login*') ? 'active' : '' }}">  <a href="{{ route('login') }}">Login </a> </li>
                            <li class="{{ Request::is('register*') ? 'active' : '' }}">  <a href="{{ route('register') }}">Register </a></li>
							
                        @else
							
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
								
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
						
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> <!-- Mega Fix (collapsed main menu won't open)-->	
	
	<!-- To register JS file for specific view only (In layout template) (for home '/' only. Loads JS for home Vue component <example>. If is loaded globally will inerfere with Appointmant vue-->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['/'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <script src="{{ asset('js/app.js') }}"></script> <!-- as included always -->
    @endif
	
	
    <!-- (for Wpress Vue.js + Vuex Framework asset only -->
	<!-- To register JS file for specific view only (In layout template) (for Wpress Vue.js + Vuex Framework asset only) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['wpBlogVueFrameWork'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <link  href="{{ asset('css/Wpress_Vue_JS/wpVue_css.css') }}" rel="stylesheet">
		<script src="{{ asset('js/Wpress_Vue_JS/wpblog-vue-start.js') }}"></script> <!-- wpress Vue JS core entry point -->
		
		
		<script src="{{ asset('js/Wpress_ImagesBlog/LightBox/lightbox.js') }}"></script>       <!-- LightBox Lib JS  -->
        <link  href="{{ asset('css/Wpress_Images/LightBox/lightbox.css') }}" rel="stylesheet"> <!-- LightBox Lib CSS -->
        
        <link  href="{{ asset('css/Wpress_Vue_JS/Element_UI/theme-chalk/index.css') }}" rel="stylesheet"> <!-- Elememt-UI icons (fix)  -->
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->        
	@endif

    
    <!-- (for Wpress Vue Admin Part asset only -->
	<!-- To register JS file for specific view only (In layout template) (Wpress Admin Part asset only) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['adminStart'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <link  href="{{ asset('css/WpBlog_Admin_Part/wp_admin.css') }}" rel="stylesheet">
		<script src="{{ asset('js/WpBlog_Admin_Part/wpblog-admin-part-start.js') }}"></script> <!-- wpress Vue JS Admin Part core entry point -->
		
		
		<script src="{{ asset('js/Wpress_ImagesBlog/LightBox/lightbox.js') }}"></script>       <!-- LightBox Lib JS  -->
        <link  href="{{ asset('css/Wpress_Images/LightBox/lightbox.css') }}" rel="stylesheet"> <!-- LightBox Lib CSS -->
        
        <link  href="{{ asset('css/Wpress_Vue_JS/Element_UI/theme-chalk/index.css') }}" rel="stylesheet"> <!-- Elememt-UI icons (fix)  -->
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->        
	@endif
	<!-- ALL OTHER/SOME OTHER CSS/JS SCRIPT ARE LOADED IN EVERY SPECIFIC VIEW (before {endsection}) -->

</body>
</html>
