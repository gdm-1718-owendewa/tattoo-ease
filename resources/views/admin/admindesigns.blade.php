@extends('layouts.app')
@section('content')
<div class="admin-container">
    <div class="table-responsive">
        <table class="table contact-table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col" >Title</th>
                    <th scope="col">Aritst</th>
                    <th scope="col">Artist Tel</th>
                </tr>
            </thead>
            @foreach ($designs as $d)
                <tr>
                    <td><img class="admin-design-table-img" src="{{asset('/images/'.$d->artistinfo->id.'/'.$d->image)}}"></td>
                    <td>{{$d->design_title}}</td>
                    <td>{{$d->artistinfo->name}}</td>
                    <td>{{$d->artistinfo->tel}}</td>
                    <td> <a class="btn "   style="background:#f1c33b"href="/gallery/edit/{{$d->id}}"><img src="{{asset('/icons/edit.svg')}}"></a><a class="btn btn-danger" onclick="return confirm('Bent u zeker dat u dit design wil verwijderen')" href="{{route('admin-designs-delete', $d->id)}}"><img src="{{asset('/icons/trash.svg')}}"></a></td>
            
            
                </tr>
                
            @endforeach
        </table>
    </div>
</div>
@endsection