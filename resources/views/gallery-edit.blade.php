
@extends('layouts.app')

@section('content')
<div class="container gallery-edit-container">
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
    <div class="group-div">
        <div id="leftDiv"><img src="{{$design->path}}"> </div>
        <div id="rightDiv">
            <form action="{{route('savegallery', $design->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="design-title">Designnaam</label>
                    <input class="form-control" id="design-title" name="design-title" value="{{$design->design_title}}">
                </div>
                <div class="form-group">
                    <label for="client-name">Klantnaam (voor referentie) </label>
                    <input type="text" class="form-control" name="client-name" id="client-name" value="{{$design->customer}}">
                </div>
                <div class="form-group">
                    <label for="design-info">Design info</label>
                    <textarea class="form-control" id="design-info" name="design-info" rows="5">{{$design->design_info}}</textarea>
                </div>
                <div class="form-group">
                    <label for="design-file">Design </label>
                    <input type="file" class="form-control" name="design-file" id="design-file" capture="environment">
                </div>
                <input id="contract-submit-button" type="submit" class="form-control" value="Edit design">
            </form>
        </div>
    </div>
</div>
@endsection
