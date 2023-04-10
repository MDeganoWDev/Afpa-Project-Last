@extends('templateFormulaire')

@section('content')
    <div>
        <h1>Liste des notes de service</h1>
        @if(isset($error))
            <div>{{ $error }}</div>
        @else
            <table>
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
                           <td> <embed src="{{ Storage::url($note_de_service['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" /></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
