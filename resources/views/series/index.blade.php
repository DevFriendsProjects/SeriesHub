<x-layout title="SeriesHub - Lista de séries">
    <div class="container m3">
        <h1 class="tableTitle">Lista de séries</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <div class="addseries col-md-10 ml-sm-auto col-lg-11 px-4">
        <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nome da Série</th>
                            <th>Temporadas</th>
                            <th>Temporadas Vistas</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($series as $serie)
                            <tr>
                                <td>{{ $serie->name }}</td>
                                <td>{{ $serie->seasons_count }}</td>
                                <td>?</td>
                                <td>
                                    <a href="{{ route('series.show', $serie->id) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm ms-1"><i class="fa-solid fa-pencil"></i></a>
                                    <form action="{{ route('series.destroy', $serie->id) }}" method="post" onsubmit="return confirm('Você tem certeza que deseja deletar esta série?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm ms-1"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center" style="display: flex; justify-content: center;">
                    {{ $series->links() }}
                </div>   
            </div>
        </div>
    </div>
</x-layout>