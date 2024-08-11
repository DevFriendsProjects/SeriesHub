<x-layout title="SeriesHub - Visualizar série ''{!! $serie->name !!}''">

    <div class="jumbotron text-center bg-dark">
        <h1 class="display-4">{{ $serie->name }}</h1>
        <hr>
        <form action="{{ route('seasonsWatched', $serie->id) }}" method="POST">
            @csrf
            @foreach($serie->seasons as $season)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="seasons[]" value="{{ $season->id }}" 
                            {{ $season->users->contains(auth()->user()->id) ? 'checked' : '' }}>
                <label class="form-check-label">
                Temporada: {{ $season->season_number }}
                </label>
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</x-layout>