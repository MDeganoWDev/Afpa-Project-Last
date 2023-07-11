@extends('templateFormulaire')
<link href="https://unpkg.com/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
@section('content')
<div class="relative w-screen h-screen" style="background-color: #E3007E;">
    <button class="absolute top-9 ml-40">Retour</button>
    <div class="container grid grid-rows-2 absolute h-36 top-16 ml-36 border border-solid border-black rounded-xl md:w-3/4 lg:3/4 xl:w-10/12 2xl:4/5" style="background-color: #FDF8F8;">
        <h1 class="absolute font-kanit text-4xl w-1/2 mt-14 ml-20">Règlements</h1>
        <img src="" alt="Logo Afpa" width="150" height="150" class="justify-self-end p-2">
    </div>
    <div class="container absolute h-3/4 top-56 ml-36 border rounded-xl md:w-3/4 lg:3/4 xl:w-10/12 2xl:4/5" style="background-color: #FDF8F8;">
        @if (isset($error))
        <div class="flex flex-row justify-center items-center">{{ $error }}</div>
        @else
        @if (session('success'))
        <div class="flex flex-row justify-center items-center">{{ session('success') }}</div>
        @endif
        <div class="grid grid-cols-3 m-28">
            <div class="justify-self-center self-center">
                <div>
                    <label for="titre" class="font-kanit text-lg text-center text-white border border-solid border-2 border-black grid m-2 p-2" style="background-color: #E3007E;">Règlement intérieur</label>
                    <div class="font-kanit text-lg border border-solid border-2 border-black m-2">
                        @php
                        $reglement = $reglements->firstWhere('titre', 'Règlement intérieur');
                        @endphp
                        @if (isset($reglement) && isset($reglement['pdf']))
                        <embed src="{{ Storage::url($reglement['pdf']) }}#toolbar=0" type="application/pdf" width="100%" height="400px" />
                        @else
                        Aucun fichier
                        @endif
                    </div>
                    <div class="flex justify-center">
                        @if (isset($reglement) && isset($reglement['pdf']))
                        <a href="{{ route('selectRCS', ['slug' => $reglement->slug]) }}"><button class="border boder-solid rounded-xl p-2">Modifier</button></a>
                        @else
                        <a href="{{ route('createRCS', ['titre' => 'Règlement intérieur']) }}"><button class="border boder-solid rounded-xl p-2">Ajouter</button></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="justify-self-center self-center">
                <div>
                    <label for="titre" class="font-kanit text-lg text-center text-white border border-solid border-2 border-black grid m-2 p-2" style="background-color: #E3007E;">Sécurité incendie</label>
                    <div class="font-kanit text-lg border border-solid border-2 border-black m-2">
                        @php
                        $reglement = $reglements->firstWhere('titre', 'Sécurité incendie');
                        @endphp
                        @if (isset($reglement) && isset($reglement['pdf']))
                        <embed src="{{ Storage::url($reglement['pdf']) }}#toolbar=0" type="application/pdf" width="100%" height="400px" />
                        @else
                        Aucun fichier
                        @endif
                    </div>
                    <div class="flex justify-center">
                        @if (isset($reglement) && isset($reglement['pdf']))
                        <a href="{{ route('selectRCS', ['slug' => $reglement->slug]) }}"><button class="border boder-solid rounded-xl p-2">Modifier</button></a>
                        @else
                        <a href="{{ route('createRCS', ['titre' => 'Sécurité incendie']) }}"><button class="border boder-solid rounded-xl p-2">Ajouter</button></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="justify-self-center self-center">
                <div>
                    <label for="titre" class="font-kanit text-lg text-center text-white border border-solid border-2 border-black grid m-2 p-2" style="background-color: #E3007E;">Certification</label>
                    <div class="font-kanit text-lg border border-solid border-2 border-black m-2">
                        @php
                        $reglement = $reglements->firstWhere('titre', 'Certification');
                        @endphp
                        @if (isset($reglement))
                        @if (isset($reglement['pdf']))
                        <embed src="{{ Storage::url($reglement['pdf']) }}#toolbar=0" type="application/pdf" width="100%" height="400px" />
                        @else
                        Aucun fichier
                        @endif
                        @else
                        Aucun fichier
                        @endif
                    </div>
                    <div class="flex justify-center">
                        @if (isset($reglement))
                        <a href="{{ route('selectRCS', ['slug' => $reglement['slug']]) }}"><button class="border boder-solid rounded-xl p-2">Modifier</button></a>
                        @else
                        <a href="{{ route('createRCS', ['titre' => 'Certification']) }}"><button class="border boder-solid rounded-xl p-2">Ajouter</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection