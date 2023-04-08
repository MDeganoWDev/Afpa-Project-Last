@extends('templateFormulaire')

@section('content')
    <div>
        <h1>{{ isset($reglement) ? 'Modifier' : 'Nouveau' }} règlement</h1>
        @if (isset($error))
            <div>{{ $error }}</div>
        @else
            <form action="{{ isset($reglement) ? route('updateRCS', ['slug' => $reglement->slug]) : route('saveRCS') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($reglement))
                    @method('PUT')
                @endif
                <input type="hidden" name="titre" value="{{ $titre }}">
                <div>
                    <h2>{{ $titre }}</h2>
                </div>
                <div>
                    <label for="pdf">PDF :</label>
                    <input type="file" name="pdf" id="pdf">
                    @if (isset($reglement) && isset($reglement->pdf))
                        <div>
                            <a href="{{ Storage::url($reglement->pdf) }}" target="_blank">Télécharger le fichier
                                existant</a>
                        </div>
                    @endif
                </div>
                <button type="submit">{{ isset($reglement) ? 'Modifier' : 'Créer' }}</button>
            </form>
        @endif
    </div>
@endsection
