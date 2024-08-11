<x-layout title="SeriesHub - Visualizar série ''{!! $serie->name !!}''">

    <div class="jumbotron text-center bg-dark">
        <h1 class="display-4">{{ $serie->name }}</h1>
        <hr>
        <ul>
            @foreach($serie->seasons as $season)
                <li>Temporada: {{ $season->season_number }}</li>
            @endforeach
        </ul>
    </div>
</x-layout>