@vite(['resources/css/app.css', 'resources/js/app.js'])


@extends('templateFormulaire')


@section('content')
<body style="background-color: #87BB34;">
    
</body>
    <div>
        <h1 class="text-2xl font-size: 1.5rem,line-height: 2rem, text-center">Liste des notes de services</h1>
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
    @if ($note_de_service->etat_id == 2)
        <tr>
            <td><a href="{{ route('pageNDS', ['slug' => $note_de_service['slug']]) }}">{{ $note_de_service->titre }}</a></td>
            <td> <embed src="{{ Storage::url($note_de_service['pdf']) }}.#toolbar=0" type="application/pdf" width="100%" height="600px" /></td>
        </tr>
    @endif
@endforeach

                </tbody>
            </table>
        @endif
    </div>
@endsection