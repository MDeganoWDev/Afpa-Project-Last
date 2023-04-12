@extends('templateFormulaire')

@section('content')
    <div>
        <h1>Notes de Services</h1>
        @if(isset($error))
            <div>{{ $error }}</div>
        @else
            @if(session('success'))
                <div>{{ session('success') }}</div>
            @endif
            <div><a href="{{ route('createNDS') }}">Nouvelle note de service</a></div>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Date de Création</th>
                        <th>Actions</th>
                        <th>Visibilité</th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes_de_service as $note_de_service)
                        <tr>
                            <td>{{ $note_de_service->titre }}</td>
                            <td>{{ $note_de_service->auteur }}</td>
                            <td>{{ $note_de_service->date_creation }}</td>
                            <td>{{ $note_de_service->visibilite->nom }}</td>
                            <td>{{ $note_de_service->etat->nom }}</td>
                            <td>
                                <form action="{{ route('softDeleteNDS', ['id' => $note_de_service->id]) }}.#toolbar=0" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Supprimer</button>
                                </form>
                                <a href="{{ route('selectNDS', ['id' => $note_de_service->id]) }}">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
