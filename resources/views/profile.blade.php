@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div id="welcome-container" style="background:url('{{asset('/images/profileheader.svg')}}'); background-size:cover; background-repeat:no-repeat;   background-position: center;
    ">
        <div id="welcome-text">
            <h1 id="welcome-text-h1">Welkom</h1>
            <p> {{$activeUser->name}}</p>
        </div>
    </div>
  
        <a href="{{route('profileEditPage',$activeUser->id)}}" >
             <p id="profile-edit-button">Edit</p> 
        </a>
    @if($activeUser->role == "artist")
        @if($contract)
        @else
        <div id="no-contract-message" class="clearfix">
            <div id="no-contract-text">
                <p>U heeft nog geen contract.</p>
                <p>Zonder contract zal u niet getoond worden op de site.</p>
                <p>We doen dit zodat u als artiest beschermd bent</p>
            </div>
            <div id="no-contract-button">
                <a href="{{route('contract')}}">Maak nu een contract aan</a>
            </div>
        </div>
        @endif
    @endif
    <div id="general-container">
        <div id="general-container-info" class="clearfix">
            <div class="general-container-info-segment">
                <h2>Naam</h2>
                <p>{{$activeUser->name}}</p>
            </div>
            <div class="general-container-info-segment">
                <h2>Email</h2>
                <p>{{$activeUser->email}}</p>
            </div> 
            <div class="general-container-info-segment">
                <h2>Tel</h2>
                <p>{{$activeUser->tel}}</p>
            </div>
            @if($activeUser->shopname)
            <div class="general-container-info-segment">
                <h2>Shopname</h2>
                <p>{{$activeUser->shopname}}</p>
            </div>
            <div class="general-container-info-segment">
                <h2>Shopadress</h2>
                <p>{{$activeUser->shopadress}}</p>
            </div>
            
            @endif
        </div>
        <div id="general-container-designs-contacts">
            <div id="general-container-designs" class="clearfix">
                @if($activeUser->role == "artist")
                {{-- <h2>Uw meest recente designs  </h2>
                <div class="recent-designs-container">
                    @for($i = 0; $i <4; $i++)
                      <img class="recent-designs" src="{{asset('/images/profileheader.svg')}}">
                    @endfor
                 </div> --}}
                @elseif($activeUser->role == "user")
                <div class="recent-designs-container">
                    @if($count > 0)
                        <h2>Uw goedgekeurde designs  </h2>
                        @foreach ($approvedDesigns as $item)
                        <img class="recent-designs" src="{{asset($item->design_path)}}">
                        @endforeach
                    @else
                       
                    @endif
                 </div>
                @endif
            </div>
            <div id="general-container-contacts">
                    <h2>Uw meest recente contacten  </h2>
                    <div class="table-responsive">
                        <table class="table contact-table">
                        <thead>
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tel</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($userContacts as $userContact)
                            <tr>
                                <td>{{$userContact->info->name}}</td>
                                <td>{{$userContact->info->email}}</td>
                                <td>{{$userContact->info->tel}}</td>
                                <td><a class="btn profile-contact-info-button" href="{{route('info-page', $userContact->info->id)}}"><img src="{{asset('/icons/info.svg')}}"></a>       
                                    <a  class="btn btn-danger" onclick="return confirm('Wilt u {{$userContact->info->name}} verwijderen als contact?')" href="{{route('removecontact', $userContact->id)}}"><img src="{{asset('/icons/trash.svg')}}"></a></td>
                            </tr>
                        @endforeach
                    </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
