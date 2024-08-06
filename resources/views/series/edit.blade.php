<x-layout title="SeriesHub - Atualizar Série">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <div class="container mt-2 text-center">
        <h1>Editar Série</h1><br>
        <form action="{{ route('series.update', $series->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="titulo-cadastro" class="text-center mt-4" style="color: pink; margin-right: 100px;"></h1>
            <input type="text" id="seriesInput" name="name" placeholder="Nome da série" value="{{ old('name', $series->name) }}">
            <input type="number" id="episodesInput" name="seasons" placeholder="Número de temporadas" min="1" value="{{ old('seasons', $series->seasons) }}">
            <button type="submit" class="btn btn-primary">Atualizar</button> 
            <ul id="seriesList"></ul>
        </form>
    </div>

</x-layout>
