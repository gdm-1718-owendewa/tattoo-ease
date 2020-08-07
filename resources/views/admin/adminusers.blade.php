@extends('layouts.app')
@section('content')
<div class="admin-container">
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
    <table class="table contact-table">
        <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col" >Email</th>
                <th scope="col">Tel</th>
                <th scope="col">Shopname</th>
                <th scope="col">Shopadress</th>
            </tr>
        </thead>
        @foreach ($users as $u)
            <tr>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->tel}}</td>
                @if($u->shopname)
                <td>{{$u->shopname}}</td>
                <td>{{$u->shopadress}}</td>
                @else
                <td></td>
                <td></td>
                @endif
                <td>
                    <a class="btn profile-contact-info-button" href="{{route('info-page', $u->id)}}"><img src="{{asset('/icons/info.svg')}}"></a><a  class="btn btn-danger remove-contact-button" onclick="return confirm('Wilt u {{$u->name}} verwijderen?')" href="{{route('admin-users-delete', $u->id)}}"><img src="{{asset('/icons/trash.svg')}}"></a><a class="btn" style="background:#f1c33b" href="{{route('admin-users-edit', $u->id)}}"><img src="{{asset('/icons/edit.svg')}}"></a> 
                </td>
            </tr>
            
        @endforeach
    </table>
</div>
</div>
@endsection