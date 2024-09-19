<x-layout title="SeriesHub - Visualizar série ''{!! $serie->name !!}''">
    <div class="text-center">
        <div class="bg-dark text-light p-4 rounded">
            <h1 class="display-4">Série: {{ $serie->name }}</h1>
            <hr>
            <form action="{{ route('seasonsWatched', $serie->id) }}" method="POST">
                <h4>Temporadas já assistidas:</h4>
                @csrf
                @foreach($serie->seasons as $season)
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="seasons[]" value="{{ $season->id }}" 
                               {{ $season->users->contains(auth()->user()->id) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Temporada {{ $season->season_number }}
                        </label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-3">Salvar</button>
            </form>
        </div>
    </div>
</x-layout>