
@extends('layouts.app')

@section('content')
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
        <div class="overlay gallery-overlay">
        </div>
        <div id="gallery-div">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                {{-- <a href="#" id="closeGalleryOverlay"> <img src="{{asset('/icons/close-black.svg')}}"></a> --}}
               
            </div>
    <div id="design-container">
        @if($count == 0)
            <div id="no-designs-yet">
                <p>Beste artist op dit ogenblik heeft u nog geen designs geupload</p>
                <p>Maak gebruikt van de knop onderaan om uw eerste design te uploaden!</p>
            </div>
        @else
            @foreach ($designs as $design)
                <div class="design-div">
                    <img src="{{asset('/images/'.$foldername.'/'.$design->image)}}">
                    <div class="design-div-info">
                        <h2>{{ucfirst($design->design_title)}}</h2>
                        <h5>{{ucwords($design->customer)}}</h5>
                        <p>{{$design->design_info}}</p>
                    </div>
                    <a href="/gallery/choosedesign/senddesign/{{$clientid}}/{{$design->id}}"><div class="choose-design-div">Send Design</div></a>
                </div>
                
            @endforeach
        @endif
    </div>    
    
</div>
@endsection
