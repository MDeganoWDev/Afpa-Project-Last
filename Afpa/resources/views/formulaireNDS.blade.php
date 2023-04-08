@extends('templateFormulaire')

@section('content')
    <div>
        @if(isset($note_de_service))
            <h1>Modifier la note de service {{ $note_de_service->id }}</h1>
            <form action="{{ route('updateNDS', $note_de_service->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
        @else
            <h1>Ajouter une nouvelle note de service</h1>
            <form action="{{ route('createNDS') }}" method="post" enctype="multipart/form-data">
        @endif
        @if(session('error'))
    <div>
        {{ session('error') }}
    </div>
@endif
            @csrf
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" required value="{{ isset($note_de_service) ? $note_de_service->titre : old('titre') }}">
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pdf">PDF</label>
                @if(isset($note_de_service))
                    <p>Le fichier PDF actuel est : {{ $note_de_service->pdf }}</p>
                    <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf">
                @else
                    <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf" required>
                @endif
                @error('pdf')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="auteur">Auteur</label>
                <input type="text" class="form-control @error('auteur') is-invalid @enderror" id="auteur" name="auteur" required value="{{ isset($note_de_service) ? $note_de_service->auteur : old('auteur') }}">
                @error('auteur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="date_creation">Date de création</label>
                <input type="date" class="form-control @error('date_creation') is-invalid @enderror" id="date_creation" name="date_creation" required value="{{ isset($note_de_service) ? $note_de_service->date_creation : old('date_creation') }}">
                @error('date_creation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($note_de_service) ? 'Modifier' : 'Ajouter' }}</button>
        </form>
    </div>
@endsection
