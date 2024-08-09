<x-layout title="SeriesHub - Visualizar série ''{!! $series->name !!}''">

    <div class="jumbotron text-center bg-dark">
        <h1 class="display-4">{{ $series->name }}</h1>
        <hr>
        <p class="lead">Temporadas: {{ $series->seasons }}</p>
    </div>

</x-layout>