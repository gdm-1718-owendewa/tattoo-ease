
@extends('layouts.app')

@section('content')
<div class="profile-container">
   <div id="welcome-container" style="background:url('{{asset('/images/profileheader.svg')}}'); background-size:cover; background-repeat:no-repeat;   background-position: center;
   ">
      <div id="welcome-text">
         <h1 id="welcome-text-h1">Info</h1>
         <p> {{$user->name}}</p>
      </div>
   </div>
   <div id="info-page-container">
      <div id="info-page-container-div" class="clearfix">
          <div class="">
              <h2>Naam</h2>
              <p>{{$user->name}}</p>
          </div>
          <div class="">
              <h2>Email</h2>
              <p>{{$user->email}}</p>
          </div> 
          <div class="">
              <h2>Tel</h2>
              <p>{{$user->tel}}</p>
          </div>
          
          @if($user->shopname)
          <div class="">
              <h2>Shopname</h2>
              <p>{{$user->shopname}}</p>
          </div>
          <div class="">
              <h2>Shopadress</h2>
              <p>{{$user->shopadress}}</p>
          </div>
          
          @endif
      </div>
   </div>
</div>
@endsection
