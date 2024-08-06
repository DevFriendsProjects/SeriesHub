<x-layout title="SeriesHub - Cadastrar série">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1 class="titulo-cadastro" class="text-center mt-4" style="color: pink; margin-right: 100px;">Adicione sua Série</h1>
        <input type="text" id="seriesInput" name="name" placeholder="Adicione uma série:">
        <input type="number" id="episodesInput" name="seasons" placeholder="Número de temporadas" min="1">
        <button type="submit" class="btn btn-primary">Adicionar</button> 
        <ul id="seriesList"></ul>
    </form>

</x-layout>