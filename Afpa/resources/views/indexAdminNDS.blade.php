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
        <div class="bg-white rounded-2xl m-20 text-center">
            <div class="text-center">
                <a href="{{ route('createNDS') }}">
                    <button class="bg-green-500 rounded-xl m-4 p-2">Ajouter</button>
                </a>
            </div>
            <table class="table-auto mx-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-center">Titre</th>
                        <th class="px-4 py-2 text-center">Auteur</th>
                        <th class="px-4 py-2 text-center">Date de création</th>
                        <th class="px-4 py-2 text-center">Etat</th>
                        <th class="px-4 py-2 text-center">Visibilité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes_de_service as $note_de_service)
                    <tr class="border-t-2">
                        <td class="px-4 py-2 align-middle text-center border-2 border-solid border-black">{{ $note_de_service->titre }}</td>
                        <td class="px-4 py-2 align-middle text-center border-2 border-solid border-black">{{ $note_de_service->auteur }}</td>
                        <td class="px-4 py-2 align-middle text-center border-2 border-solid border-black">{{ $note_de_service->date_creation }}</td>
                        <td class="px-4 py-2 align-middle text-center border-2 border-solid border-black">{{ $note_de_service->visibilite->nom }}</td>
                        <td class="px-4 py-2 align-middle text-center border-2 border-solid border-black">{{ $note_de_service->etat->nom }}</td>
                        <td class="px-4 py-2 align-middle flex justify-center m-2">
                            <a href="{{ route('selectNDS', ['slug' => $note_de_service['slug']]) }}">Modifier</a>
                            <form action="{{ route('DeleteNDS', ['slug' => $note_de_service['slug']]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
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