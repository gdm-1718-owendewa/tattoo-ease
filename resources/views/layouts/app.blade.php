<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="{{asset('favicon.png')}}">
    @laravelPWA
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light " >
            <div class="container">
                <a class="navbar-brand"  href="{{ url('/profile') }}">
                    Tattoo-Ease
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->role == 'artist')
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{route('profile')}}">
                                        Profile
                                    </a>
                                    <a class="nav-link" href="{{route('gallery')}}">
                                        Gallery
                                    </a>
                                    <a class="nav-link" href="{{route('contacts')}}">
                                        Contacts
                                    </a>
                                    <a class="nav-link notification-link" href="{{route('notifications')}}">
                                        Notifications
                                    </a>
                                    <a class="nav-link" href="{{route('logout')}}">
                                        Logout
                                    </a>
                                </li>
                            @elseif(Auth::user()->role == 'user')
                                <li class="nav-item dropdown">
                              
                                    <a class="nav-link" href="{{route('profile')}}">
                                        Profile
                                    </a>
                                    <a class="nav-link" href="{{route('contacts')}}">
                                        Contacts
                                    </a>
                                    <a class="nav-link" href="{{route('notifications')}}">
                                        Notifications
                                    </a>
                                    <a class="nav-link" href="{{route('logout')}}">
                                        Logout
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{route('admin-dash')}}">
                                        Dashboard 
                                    </a>
                                    <a class="nav-link" href="{{route('admin-users')}}">
                                        Users
                                    </a>
                                    <a class="nav-link" href="{{route('admin-designs')}}">
                                        Designs
                                    </a>
                                    <a class="nav-link" href="{{route('logout')}}">
                                        Logout
                                    </a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(document).ready(function() {
           
            $('#shopname-row').css('visibility', 'hidden');
            $('#shopadress-row').css('visibility', 'hidden');
        
            //set initial state.
            $('#artist').click(function() {
                if ($(this).is(':checked')) {
                    $('#shopname-row').css('visibility', 'visible');
                    $("#shopname").prop('required',true);
                    $('#shopadress-row').css('visibility', 'visible');
                    $("#shopadress").prop('required',true);
                    $('#artist').val('artist');

                }
                else if(!$(this).is(':checked')) {
                    $('#shopname-row').css('visibility', 'hidden');
                    $("#shopname").prop('required',false);
                    $("#shopname").val(null);
                    $('#shopadress-row').css('visibility', 'hidden');
                    $("#shopadress").prop('required',false);
                    $("#shopadress").val(null);
                    $('#artist').val('user');

                }
            });
            $('.notification-image').click(function(e){
                $('.notification-overlay').css('display', 'block');
                $('.notificaion-overlay-image-div').append( "<img class='notification-overlay-image' src=" + $(this).attr('value') + ">" )
                $('.notificaion-overlay-image-div').css('display', 'block')
            });
            $('.notification-overlay').click(function(){
                $('.notification-overlay').css('display', 'none');
                $('.notificaion-overlay-image-div').css('display', 'none')
                $('.notification-overlay-image').remove()
            });
            $('.closeImageOverlayButton').click(function(e){
                e.preventDefault();
                $('.notification-overlay').css('display', 'none');
                $('.notificaion-overlay-image-div').css('display', 'none')
                $('.notification-overlay-image').remove()
            });
            $('.openGalleryButton').click(function(e){
                e.preventDefault();
                $('.gallery-overlay').css('display', 'block');
                $('#gallery-div').css('display', 'block');
                $('.openGalleryButton').css('display', 'none');
            });
            $('.gallery-overlay').click(function(){
                $('.gallery-overlay').css('display', 'none');
                $('#gallery-div').css('display', 'none');
                $('.openGalleryButton').css('display', 'block');
            });
            $('.decline-design').click(function(e){
                e.preventDefault();
                $actionvalue = $(this).attr('value');
                window.scrollTo(0, 0);

                $('#notification-form').attr('action', $actionvalue)
                $('.notification-overlay').css('display', 'block');
                $('#notification-div').css('display', 'block');
            });
            $('.notification-overlay').click(function(){
                $('.notification-overlay').css('display', 'none');
                $('#notification-div').css('display', 'none');
            });
    
            $('.contact-overlay').click(function(){
                $('.contact-overlay').css('display', 'none');
                $('.contact-contract-div').css('display', 'none');
                $('.contract-info-div').remove()

            });
           
            $(document).on("click", "#refuse-contract", function(){
                $('.contact-overlay').css('display', 'none');
                $('.contact-contract-div').css('display', 'none');
                $('.contract-info-div').remove()
            });
            $(document).on("click", ".add-contact-button", function(e){
                e.preventDefault();
                window.scrollTo(0, 0);
                let route = $(this).attr('value')
                $('.contact-sessions-messages').css('display', 'none');
                $('.contact-overlay').css('display', 'block');
                $('.contact-contract-div').css('display', 'block');
               
                $('.contact-contract-div').append( "<div class='contract-info-div'><h1>Artist contract</h1><p>Om u en de artiest te beschermen in eventueel verdere discussies in de toekomst vragen we u het contract opgesteld door de artiest te aanvaarden. Zie heronder de specificaties van het contract.<h2>Aanpassings limiet</h2><p>Hierbij geeft de arist op dat u een maximum van "+$(this).attr('data-change') + " aanpassingen heeft bij u ontwerp. Deze aanpassingen kunnen gaan van de kleuren tot het volledige design zelf.</p><h2>Algemene info</h2><p>"+ $(this).attr('data-rules')+"</p><div class='contact-contract-div-buttons'><a href='" + route + "' class='btn btn-success'>Aanvaard</a> <a href='#' class='btn btn-danger' id='refuse-contract'>Weiger</a></div></div>" )
            });
        });
    </script>
</body>
</html>
