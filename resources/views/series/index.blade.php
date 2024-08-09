<x-layout title="SeriesHub - Lista de séries">

    <div class="container mt-2 text-center">
        <h1>Lista de Séries</h1><br>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-dark">
            <thead class="align-left thead-dark">
                <tr>
                    <th scope="col" width="10%">Nome</th>
                    <th scope="col" width="70%">Temporadas</th>
                    <th scope="col" width="20%">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($series as $serie)
                    <tr>
                        <td>{{ $serie->name }}</td>
                        <td>{{ $serie->seasons }}</td>
                        <td>
                            <span>
                                <a href="#" class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm ms-1"><i class="fa-solid fa-pencil"></i></a>
                                <form action="{{ route('series.destroy', $serie->id) }}" method="post" onsubmit="return confirm('Você tem certeza que deseja deletar esta série?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm ms-1"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{ $series->links() }}
        </div>
    </div>

</x-layout>