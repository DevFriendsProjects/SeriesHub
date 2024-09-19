<x-layout title="Atualizar Série">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="addseries col-md-10 ml-sm-auto col-lg-11 px-4">
        <div class="container mt-2 text-center">
            <h1>Editar Série</h1>

            <form action="{{ route('series.update', $series->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="seriesInput">Nome da Série:</label>
                    <input type="text" id="seriesInput" name="name" class="form-control" value="{{ old('name', $series->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="seasonsInput">Número de Temporadas:</label>
                    <input type="number" id="seasonsInput" name="seasons" class="form-control" min="1" max="100" value="{{ old('seasons', $series->seasons()->count()) }}" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
            </form>
        </div>
    </div>

</x-layout>