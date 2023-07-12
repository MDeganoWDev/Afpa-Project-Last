@extends('templateFormulaire')
<link href="https://unpkg.com/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
@section('content')
    <div class="relative w-screen h-screen overflow-auto" style="background-color: #E3007E;">
        <div class="container grid grid-rows-2 absolute h-36 top-14 ml-36 border border-solid border-black rounded-xl sm:w-32 md:w-3/4 lg:3/4 xl:w-10/12 2xl:4/5" style="background-color: #FDF8F8;">
            <h1 class=" absolute font-kanit text-4xl w-1/2 mt-14 ml-20">{{ isset($reglement) ? 'Modifier' : 'Nouveau' }} règlement</h1>
            <img src="" alt="Logo Afpa" width="150" height="150" class="justify-self-end">
        </div>
        @if (isset($error))
            <div>{{ $error }}</div>
        @else
            <form action="{{ isset($reglement) ? route('updateRCS', ['slug' => $reglement->slug]) : route('saveRCS') }}"
                method="POST" enctype="multipart/form-data" class="container flex flex-col content-center absolute top-56 ml-36 border rounded-xl md:w-3/4 lg:3/4 xl:w-10/12 2xl:4/5" style="background-color: #FDF8F8;">
                @csrf
                @if (isset($reglement))
                    @method('PUT')
                @endif
                <input type="hidden" name="titre" value="{{ $titre }}">
                <div class="font-kanit text-center text-4xl mt-9  p-2">
                    <h2>{{ $titre }}</h2>
                </div>
                <div class="font-kanit text-center mt-9 ml-20">
                    @if (isset($reglement) && isset($reglement->pdf))
                    <div class="w-1/2 border border-solid border-black ml-80 p-2">
                        <embed src="{{ Storage::url($reglement['pdf']) }}#toolbar=0" type="application/pdf" width="100%" height="500px" />
                    </div>
                    @endif
                    <label for="pdf">PDF :</label>
                    <input type="file" name="pdf" id="pdf">
                </div>
                <div class="flex flex-col flex-wrap content-center p-2">
                <button type="submit" class="border border-solid rounded-xl w-20">{{ isset($reglement) ? 'Modifier' : 'Créer' }}</button>
                </div>
            </form>
        @endif
    </div>
@endsection
