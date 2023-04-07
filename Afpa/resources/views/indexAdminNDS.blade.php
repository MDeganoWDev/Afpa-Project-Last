@extends('templateFormulaire')

@section('content')
    <div class="container">
        <h1>Notes de service</h1>
        <div class="row mb-3">
        @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="col">
        <a href="{{ route('createNDS') }}" class="btn btn-primary">Nouvelle note de service</a>
    </div>
</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes_de_service as $note_de_service)
                    <tr>
                        <td>{{ $note_de_service->titre }}</td>
                        <td>{{ $note_de_service->auteur }}</td>
                        <td>{{ $note_de_service->date_creation }}</td>
                        <td>
                            <form action="{{ route('softDeleteNDS', ['id' => $note_de_service->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                            <a href="{{ route('upNDS', ['id' => $note_de_service->id]) }}" class="btn btn-primary">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
