<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@extends('templateFormulaire')

@section('content')

<body style="background-color: #87BB34">
    <div>
        @if(isset($note_de_service))
        <h1>Modifier la note de service {{ $note_de_service->id }}</h1>
        <form action="{{ route('updateNDS', ['slug' => $note_de_service['slug']]) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @else
            <div class="flex justify-around items-center bg-white border-2 border-solid border-black rounded-3xl m-20">
                <div>
                    <h1 class="text-4xl uppercase">Ajout nouvelle note de service</h1>
                    <p>Vous pouvez ajouter une nouvelle note de service en remplissant le formulaire ci-dessous.</p>
                </div>
                <img src="{{ asset('images/afpa.jpg') }}" alt="logo AFPA" width="200" height="200">
            </div>

            <form action="{{ route('saveNDS') }}" method="post" enctype="multipart/form-data">
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
                    <p>Le fichier PDF actuel est :</p>
                    <embed src="{{ Storage::url($note_de_service['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" />
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
                    <div class="form-group">
                        <label for="visibilite">Visibilité</label>
                        <select class="form-control" id="visibilite" name="visibilite">
                            @foreach ($visibilites as $visibilite)
                            <option value="{{ $visibilite->id }}" @if(isset($note_de_service) && $note_de_service->visibilite_id == $visibilite->id) selected @endif>{{ $visibilite->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="etat">État</label>
                        <select class="form-control" id="etat" name="etat">
                            @foreach ($etats as $etat)
                            <option value="{{ $etat->id }}" @if(isset($note_de_service) && $note_de_service->etat_id == $etat->id) selected @endif>{{ $etat->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($note_de_service) ? 'Modifier' : 'Ajouter' }}</button>
            </form>
            
    </div>
    @endsection