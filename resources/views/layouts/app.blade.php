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
                                    <a class="nav-link" href="/profile">
                                        Profile
                                    </a>
                                    <a class="nav-link" href="/gallery">
                                        Gallery
                                    </a>
                                    <a class="nav-link" href="/contacts">
                                        Contacts
                                    </a>
                                    <a class="nav-link notification-link" href="/notifications">
                                        Notifications
                                    </a>
                                    <a class="nav-link" href="/logout">
                                        Logout
                                    </a>
                                </li>
                            @elseif(Auth::user()->role == 'user')
                                <li class="nav-item dropdown">
                              
                                    <a class="nav-link" href="/profile">
                                        Profile
                                    </a>
                                    <a class="nav-link" href="/contacts">
                                        Contacts
                                    </a>
                                    <a class="nav-link" href="/notifications">
                                        Notifications
                                    </a>
                                    <a class="nav-link" href="/logout">
                                        Logout
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/admin-dash">
                                        Dashboard 
                                    </a>
                                    <a class="nav-link" href="/admin/users">
                                        Users
                                    </a>
                                    <a class="nav-link" href="/admin/designs">
                                        Designs
                                    </a>
                                    <a class="nav-link" href="/logout">
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
           
            let check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})  ;
           
            if(!check){
                $('.btn-show-design').css('display','none')
            }
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
                $actionvalue = '/decline-design' + $(this).attr('value');
                $('#notification-form').attr('action', $actionvalue)
                $('.notification-overlay').css('display', 'block');
                $('#notification-div').css('display', 'block');
            });
            $('.notification-overlay').click(function(){
                $('.notification-overlay').css('display', 'none');
                $('#notification-div').css('display', 'none');
            });
            $('.add-contact-button').click(function(e){
                e.preventDefault();
                window.scrollTo(0, 0);
                $('.contact-sessions-messages').css('display', 'none');
                $('.contact-overlay').css('display', 'block');
                $('.contact-contract-div').css('display', 'block');
               
                $('.contact-contract-div').append( "<div class='contract-info-div'><h1>Artist contract</h1><p>Om u en de artiest te beschermen in eventueel verdere discussies in de toekomst vragen we u het contract opgesteld door de artiest te aanvaarden. Zie heronder de specificaties van het contract.<h2>Aanpassings limiet</h2><p>Hierbij geeft de arist op dat u een maximum van "+$(this).attr('data-change') + " aanpassingen heeft bij u ontwerp. Deze aanpassingen kunnen gaan van de kleuren tot het volledige design zelf.</p><h2>Algemene info</h2><p>"+ $(this).attr('data-rules')+"</p><div class='contact-contract-div-buttons'><a href='/contacts/add/"+$(this).attr('value')+"' class='btn btn-success'>Aanvaard</a> <a href='#' class='btn btn-danger' id='refuse-contract'>Weiger</a></div></div>" )

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
        });
    </script>
</body>
</html>
