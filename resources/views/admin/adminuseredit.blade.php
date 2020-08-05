@extends('layouts.app')
@section('content')
@if($user->role == "artist")
    <div class="container profile-edit-container">
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
            @if($contract)
                <form  action="{{route('saveprofilecontract', $user->id)}}" method="POST">
                    @csrf
                    <h2>Edit Contract </h2>
                    <input type="hidden" class="form-control" name="contract_id" value="{{$contract->id}}">
                    <div class="form-group">
                        <label for="change_limit">Change Limit</label>
                        <input type="text" class="form-control" name="change_limit" value="{{$contract->change_limit}}">
                    </div>
                    <div class="form-group">
                        <label for="general_info">Algemene info</label>
                        <textarea class="form-control" name="general_info" rows="5" style="resize:none;">{{$contract->general}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @else
                <div id="no-contract-message" class="clearfix">
                    <div id="no-contract-text">
                        <p>U heeft nog geen contract.</p>
                        <p>Zonder contract zal u niet getoond worden op de site.</p>
                        <p>We doen dit zodat u als artiest beschermd bent</p>
                    </div>
                    <div id="no-contract-button">
                        <a href="/contract">Maak nu een contract aan</a>
                    </div>
                </div>
            @endif
        <form  action="{{route('saveprofile', $user->id)}}" method="POST">
                @csrf
            <h2>Edit Info </h2>
            <div class="form-group">
                <label for="user-name">Name</label>
                <input type="text" class="form-control" name="user-name" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="user-email">Email address</label>
                <input type="email" class="form-control" name="user-email" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="user-password">Password</label>
                <input type="password" class="form-control" name="user-password" placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="user-password-confirm">Confirm password</label>
                <input type="password" class="form-control" name="user-password-confirm" placeholder="Confirm password">
            </div>
            <div class="form-group">
                <label for="user-tel">Tel</label>
                <input type="text" class="form-control" name="user-tel" value="{{$user->tel}}">
            </div>
            <div class="form-group">
                <label for="user-shopname">Shopname</label>
                <input type="text" class="form-control" name="user-shopname" value="{{$user->shopname}}">
            </div>
            <div class="form-group">
                <label for="user-shopadress">Shopadress</label>
                <input type="text" class="form-control" name="user-shopadress" value="{{$user->shopadress}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@elseif($user->role == "user" || $user->role == "admin")
    <div class="container profile-edit-container-user">
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
    <form action="{{route('saveprofile', $user->id)}}" method="POST">
            @csrf
            <h2>Edit Info </h2>
            <div class="form-group">
                <label for="user-name">Name</label>
                <input type="text" class="form-control" name="user-name" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="user-email">Email address</label>
                <input type="email" class="form-control" name="user-email" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="user-password">Password</label>
                <input type="password" class="form-control" name="user-password" placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="user-password-confirm">Confirm password</label>
                <input type="password" class="form-control" name="user-password-confirm" placeholder="Confirm password">
            </div>
            <div class="form-group">
                <label for="user-tel">Tel</label>
                <input type="text" class="form-control" name="user-tel" value="{{$user->tel}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endif
@endsection