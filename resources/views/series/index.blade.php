<x-layout title="SeriesHub - Lista de séries">
    <div class="container">
        <div class="addseries col-md-10 ml-sm-auto col-lg-11 px-4">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="tableTitle">Lista de séries</h1>
            <div class="table-container mt-3">
                @if ($series->isEmpty())
                    <div class="alert alert-warning text-center">
                        Nenhuma série cadastrada. Cadastre uma série para ter acesso a sua lista.
                    </div>
                @else
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
                                    <td>{{ $serie->seasons->count() }}/{{ $serie->seasons_count }}</td> <!-- Exibe o número de temporadas assistidas -->
                                    <td>
                                        <div class="d-flex justify-content-between mt-2">
                                            <form action="{{ route('series.show', $serie->id) }}" method="get" class="flex-grow-1 mx-1">
                                                <button class="btn btn-success btn-sm w-100">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('series.edit', $serie->id) }}" method="get" class="flex-grow-1 mx-1">
                                                <button class="btn btn-primary btn-sm w-100">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('series.destroy', $serie->id) }}" method="post" onsubmit="return confirm('Você tem certeza que deseja deletar esta série?');" class="flex-grow-1 mx-1">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm w-100">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                                  
                    </table>
                    <div class="text-center" style="display: flex; justify-content: center;">
                        {{ $series->links() }}
                    </div>   
                @endif
            </div>
        </div>
    </div>
</x-layout>