@extends('templateFormulaire')

@section('content')
    <div>
        <h1>Règlements</h1>
        @if (isset($error))
            <div>{{ $error }}</div>
        @else
            @if (session('success'))
                <div>{{ session('success') }}</div>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reglements as $reglement)
                        <tr>
                            <td>{{ $reglement->titre }}</td>
                            <td>
                                @if (isset($reglement->pdf))
                                    <a href="{{ Storage::url($reglement->pdf) }}" target="_blank">Télécharger</a>
                                @else
                                    Aucun fichier
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
