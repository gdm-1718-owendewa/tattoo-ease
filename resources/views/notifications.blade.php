
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="overlay notification-overlay">
    </div>
    <div class="notificaion-overlay-image-div"> <a href='#' class='closeImageOverlayButton'>X</a></div>
    <div id="notification-div">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Vergeet niet u kan maar het aantal toegelaten afwijzigen van uw artiest zijn/haar contrect uit gebruiken.</p>
        <p>Wees duidelijk in de reden waarom u dit design hebt afgewezen.</p>

        <form id="notification-form" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="design-decline-reason">Decline reden</label>
                <textarea style="resize:none;" class="form-control" id="design-decline-reason" name="design-decline-reason" rows="5"></textarea>
            </div>
        
            <input id="contract-submit-button" type="submit" class="form-control" value="Decline design">
        </form>
    </div>
    
   @if($activeUser->role == "user")
   @if ($errors->any())
    <div class="alert alert-danger">
        <p>Uw reden was niet ingevuld gelieve een reden in te vullen of u kan het design niet weigeren</p>
    </div>
    @endif
   <div id="notifications-container">
        @foreach ($notifications as $n)
            
            <div class="notification-div clearfix">
                <div class="notification-div-image"> <img  class="notification-image" value="{{asset($n->design_path)}}" src="{{asset($n->design_path)}}"></div>
                <div class="notification-div-message"><p>{{$n->artistInfo->name}} Heeft u een nieuw design gestuurd</p></div>
            <div class="notification-div-buttons"><a class="btn btn-info btn-show-design" href="tattoo-ease://url?{{public_path($n->design_path)}}"><img src="{{asset('/icons/show.svg')}}"></a>@if($n->decline_count < $n->change_limit)<a class="btn btn-danger decline-design" href="#" value="/{{$n->id}}/{{$n->artist_id}}/{{$n->design_id}}/{{auth()->user()->id}}"><img value="/{{$n->id}}/{{$n->artist_id}}/{{$n->design_id}}/{{auth()->user()->id}}" src="{{asset('/icons/decline.svg')}}"></a>@endif<a class="btn btn-success" href="/accept-design/{{$n->id}}/{{$n->artist_id}}/{{$n->design_id}}/{{auth()->user()->id}}" onclick="return confirm('Bent u zeker dat u dit design wilt accepteren')"><img src="{{asset('/icons/check.svg')}}"></a></div>
            </div>
        @endforeach
    </div>
   @elseif($activeUser->role == "artist")
    <div id="notifications-container">
       
        <h1 style="margin-top:1rem;">Declined Designs</h1>
        @foreach ($notifications['declined'] as $na)
        <div class="notification-div clearfix">
            <div class="notification-div-decline-image"> <img  class="notification-image" value="{{asset($na->design_path)}}" src="{{asset($na->design_path)}}"></div>
            <div class="notification-div-decline-message"><p>{{$na->clientInfo->name}} Heeft uw design geweigerd om volgende reden(en){{$na->reason}} </p></div>
            <div class="notification-div-accept-buttons">
                <a class="btn btn-primary" href="{{route('info-page', $na->clientInfo->id)}}"><img src="{{asset('/icons/info.svg')}}"></a>  
                <a class="btn profile-contact-info-button" href="{{route('gallerychoosedesigns', $na->clientInfo->id)}}"><img src="{{asset('/icons/mail.svg')}}"></a>
            </div>
        </div>
        @endforeach
        <h1 style="margin-top:1rem;">Accepted Designs</h1>
        @foreach ($notifications['accepted'] as $na)
            <div class="notification-div clearfix">
                <div class="notification-div-accept-image"> <img  class="notification-image" value="{{asset($na->design_path)}}" src="{{asset($na->design_path)}}"></div>
                <div class="notification-div-accept-message"><p>{{$na->clientInfo->name}} Heeft uw design aanvaard </p></div>
                <div class="notification-div-decline-buttons">
                    <a class="btn btn-primary" href="{{route('info-page', $na->clientInfo->id)}}"><img src="{{asset('/icons/info.svg')}}"></a>  
                    <a class="btn profile-contact-info-button " href="{{route('gallerychoosedesigns', $na->clientInfo->id)}}"><img src="{{asset('/icons/mail.svg')}}"></a>
                </div>
            </div>
            </div>
        @endforeach
    </div>
   @endif
</div>
@endsection


