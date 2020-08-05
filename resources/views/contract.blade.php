
@extends('layouts.app')
@section('content')
<div class="container">
    <div id="contract-div">
        <div id="contract-info-div">
            <h2>Maak uw contract aan</h2>
            <p>
                Als artist willen we u geruststellen doormiddel van een contractuele overeenkomst.
                Hieronder zal u wat info moeten ingeven om het contract af te werken. 
                Het contract bevat standaard de koninklijke overeenkomst dus op dit gebied gaat de artist akkoord dat hij/zij voldoet aan deze voorwaarden omtrent ( hygiëne, etc…)
            </p>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="contract-form" method="POST" action="{{route('createcontract', $activeUser->id)}}">
            @csrf
            <div class="form-group">
                <label for="algemeene-info">Werkwijze (Vul hier uw algemene regels en / of werkwijze in)</label>
                <textarea class="form-control" id="algemeene-info" name="algemeene-info" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="aanpassings-limiet">Aanpassings limiet</label>
                <input type="number" class="form-control" name="aanpassings-limiet" id="aanpassings-imiet" placeholder="Vul hier uw aanpassings limiet in">
            </div>
            <input id="contract-submit-button" type="submit" class="form-control" value="Maak contract aan">
        </form>
</div>  
</div>
@endsection
