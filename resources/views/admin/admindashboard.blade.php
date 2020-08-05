@extends('layouts.app')
@section('content')
<div class="container">
    <div id="admin-welcome-div" class="clearfix">
        <div id="image-div">
            <img src="{{asset('/images/office.jpg')}}">
        </div>
        <div id="message-div">
            <h2>Welkom {{$activeUser->name}} </h2>
           <p>Welkom op het admin dashboard dit is de landingspage om als admin de webapp te regelen. U kan de users en designs aanpassen. De notifications worden niet aanpasbaar gesteld omdat de users/artists dit zelf heel simpel kunnen oplossen</p>
        </div>
    </div>
    <div id="general-site-info" class="clearfix">
        <div class="general-site-info-section">
            
            <p>{{$userAmount}}</p>
            <h2>Users</h2>
        </div>
        <div class="general-site-info-section">
           
            <p>{{$recentUserAmount}}</p>
            <h2>Recent users</h2>
        </div>
        <div class="general-site-info-section">
            
            <p>{{$designAmount}}</p>
            <h2>Designs</h2>
        </div>
    </div>

</div>
@endsection