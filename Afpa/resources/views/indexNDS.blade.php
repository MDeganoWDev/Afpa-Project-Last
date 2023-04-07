@extends('templateFormulaire')

@section('content')
    <div class="container">
        <h1>Liste des notes de service</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>PDF</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes_de_service as $note_de_service)
                    <tr>
                        <td>{{ $note_de_service->titre }}</td>
                        <td><a href="{{ Storage::url($note_de_service->pdf) }}" target="_blank">Télécharger</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
