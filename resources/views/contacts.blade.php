
@extends('layouts.app')

@section('content')
<div class="overlay contact-overlay">
</div>
<div class="contact-contract-div">
</div>
<div class="container">
    @if (session('fail'))
        <div class="alert alert-danger col-lg-12">
            {{ session('fail') }}
        </div>
    @endif
    @if (session('succes'))
        <div class="alert alert-success col-lg-12">
            {{ session('succes') }}
        </div>
    @endif
    <div class="table-responsive">
        @if(auth()->user()->role =="artist")
            <h1 class="contact-title">Connected clients</h1>
            <table class="table contact-table">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col" >Email</th>
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
                        <a class="btn profile-contact-info-button" href="{{route('gallerychoosedesigns', $userContact->info->id)}}"><img src="{{asset('/icons/mail.svg')}}"></a>
                    <a  class="btn btn-danger remove-contact-button" onclick="return confirm('Wilt u {{$userContact->info->name}} verwijderen als contact?')" href="{{route('removecontact', $userContact->id)}}"><img src="{{asset('/icons/trash.svg')}}"></a></td>
                        
                    </tr>
                @endforeach
            </table>
        @elseif(auth()->user()->role =="user")
            <h1 class="contact-title">Connected artists</h1>
            <table class="table contact-table">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col" >Email</th>
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
                    <a  class="btn btn-danger remove-contact-button" onclick="return confirm('Wilt u {{$userContact->info->name}} verwijderen als contact?')" href="{{route('removecontact', $userContact->id)}}"><img src="{{asset('/icons/trash.svg')}}"></a></td>
                        
                    </tr>
                @endforeach
            </table>
            <h1 class="contact-title">Non connected artists</h1>
            <table class="table contact-table">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col" >Email</th>
                        <th scope="col">Tel</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                @foreach ($allArtists as $artist)
                    @if(!$artist->friended && $artist->contractinfo != null)
                        <tr>
                            <td>{{$artist->name}}</td>
                            <td>{{$artist->email}}</td>
                            <td>{{$artist->tel}}</td>
                        <td><a class="btn profile-contact-info-button" href="{{route('info-page', $artist->id)}}"><img src="{{asset('/icons/info.svg')}}"></a> 
                        <a class="btn btn-success add-contact-button" href="#" value="{{$artist->id}}" data-change="{{$artist->contractinfo->change_limit}}" data-rules="{{$artist->contractinfo->general}}"><img src="{{asset('/icons/add.svg')}}"></a> 
                        </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        @endif
    </div>
</div>
@endsection
