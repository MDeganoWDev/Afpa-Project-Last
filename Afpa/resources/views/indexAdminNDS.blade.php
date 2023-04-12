<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@extends('templateFormulaire')

@section('content')

<body style="background-color: #87BB34">
    <div>
        <div class="flex justify-around items-center bg-white border-2 border-solid border-black rounded-3xl m-20">
            <h1 class="text-4xl">MENU NOTES DE SERVICE</h1>
            <img src="{{ asset('images/afpa.jpg') }}" alt="logo AFPA" width="200" height="200">
        </div>
        @if(isset($error))
        <div>{{ $error }}</div>
        @else
        @if(session('success'))
        <div>{{ session('success') }}</div>
        @endif
        <div class="bg-white rounded-2xl m-20 text-center p-8">
            <a href="{{ route('createNDS') }}" class="text-center">
                <button class="bg-green-600 rounded-xl m-4 p-2">Ajouter button | +</button>
            </a>
            <table class="table-auto mx-auto">
                <thead>
                    <tr>
                        <th class="px-8 py-4 text-center uppercase">Titre</th>
                        <th class="px-8 py-4 text-center uppercase">Auteur</th>
                        <th class="px-8 py-4 text-center uppercase">Date de création</th>
                        <th class="px-8 py-4 text-center uppercase">Etat</th>
                        <th class="px-8 py-4 text-center uppercase">Visibilité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes_de_service as $note_de_service)
                    <tr>
                        <td class="px-auto py-auto align-middle  text-center border-2 border-solid border-black capitalize">{{ $note_de_service->titre }}</td>
                        <td class="px-auto py-auto align-middle text-center border-2 border-solid border-black capitalize">{{ $note_de_service->auteur }}</td>
                        <td class="px-auto py-auto align-middle text-center border-2 border-solid border-black capitalize">{{ $note_de_service->date_creation }}</td>
                        <td class="px-auto py-auto align-middle text-center border-2 border-solid border-black capitalize">{{ $note_de_service->visibilite->nom }}</td>
                        <td class="px-auto py-auto align-middle text-center border-2 border-solid border-black capitalize">{{ $note_de_service->etat->nom }}</td>
                        <td class="px-auto py-auto align-middle flex text-center">
                            <a href="{{ route('selectNDS', ['slug' => $note_de_service['slug']]) }}"><button class="bg-blue-600 rounded-xl m-4 p-2">Modifier | #</button></a>
                            <form action="{{ route('DeleteNDS', ['slug' => $note_de_service['slug']]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 rounded-xl m-4 p-2">Supprimer | X</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @endsection