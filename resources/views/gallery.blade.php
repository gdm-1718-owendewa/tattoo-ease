
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
                <form id="gallery-form" method="POST" action="{{route('galleryAddDesign')}}" enctype="multipart/form-data">
                    <div class="note-div">
                        <h4>Note!</h4>
                        <p>Als uw clienten de mobile app gebruiken om de plaatsing van uw tattoo design te bepalen / bekijken vergeet dan niet dat uw design als een png(met transparante achtergrond) het beste zal uitkomen.</p>
                    </div>
                    @csrf
                    <div class="form-group">
                        <label for="design-title">Designnaam</label>
                        <input class="form-control" id="design-title" name="design-title" placeholder="Vul hier uw design naam in">
                    </div>
                    <div class="form-group">
                        <label for="client-name">Klantnaam (voor referentie) </label>
                        <input type="text" class="form-control" name="client-name" id="client-name" placeholder="Vul hier uw klant zijn/haar naam in">
                    </div>
                    <div class="form-group">
                        <label for="design-info">Design info</label>
                        <textarea class="form-control" id="design-info" name="design-info" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="design-file">Design </label>
                        <input type="file" class="form-control" name="design-file" id="design-file" capture="environment">
                    </div>
                    <input id="contract-submit-button" type="submit" class="form-control" value="Voeg design toe">
                </form>
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
                    <a href="/gallery/edit/{{$design->id}}"><div class="edit-design-div">Edit</div></a>

                </div>
            @endforeach
        @endif
    </div>    
    <div id="addDesignButton">
        <a href="#" class="openGalleryButton">
            <img src="{{asset('/icons/plus.svg')}}">
        </a>
    </div>
</div>
@endsection
