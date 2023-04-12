<head>

    <!-- <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        body {
            background-color: #87BB34;
        }

        .menu-header {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #FDF8F8;
            padding: 40px;
            margin: 40px 20px;
            border: 3px solid black;
            border-radius: 20px;

        }

        h1 {
            font-family: 'Kanit', sans-serif;
            font-size: 40px;
            font-weight: 300;
        }

        .main-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #FDF8F8;
            padding: 40px;
            margin: 40px 20px;
            border: 3px solid black;
            border-radius: 20px;
        }
    </style> -->

</head>

@extends('templateFormulaire')

@section('content')
<div>
    <div class="menu-header">
        <h1>MENU NOTES DE SERVICE</h1>
        <img src="{{ asset('images/afpa.jpg') }}" alt="logo AFPA" width="100" height="100">
    </div>

    @if(isset($error))
    <div>{{ $error }}</div>
    @else
    @if(session('success'))
    <div>{{ session('success') }}</div>
    @endif
    <div class="main-section">
        <div>
            <a href="{{ route('createNDS') }}">
                <button>Ajouter</button>
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date de création</th>
                    <th>Etat</th>
                    <th>Visibilité</th>
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
                    <td class="flex">
                        <form action="{{ route('softDeleteNDS', ['id' => $note_de_service->id]) }}.#toolbar=0" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                        <a href="{{ route('selectNDS', ['id' => $note_de_service->id]) }}"><button>Modifier</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection