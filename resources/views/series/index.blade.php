<x-layout title="SeriesHub - Lista de séries">

<?php 
    /*
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
                        <td>{{ $serie->seasons_count }}</td>
                        <td>
                            <span>
                                <a href="{{ route('series.show', $serie->id) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></a>
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
    */ 
?>


<?php 
    /*
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/series.css') }}">

    <div class="container mt-2">
        <h1 class="text-center mb-4">Séries Adicionadas</h1>
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Série</th>
                    <th>Temporadas</th>
                    <th>Temporadas Vistas</th>
                </tr>
            </thead>
            <tbody>
              
                <tr>
                    <td>Game Of Thrones</td>
                    <td>5</td>
                    <td>2</td>
                </tr>

                <tr>
                    <td>Breaking Bad</td>
                    <td>5</td>
                    <td>1</td>
                </tr>

                <tr>
                    <td>Prison Break</td>
                    <td>7</td>
                    <td>4</td>
                </tr>

                <tr>
                    <td>Anime de jogar bola</td>
                    <td>100</td>
                    <td>0</td>
                </tr>

                <tr>
                    <td>Azagal</td>
                    <td>15</td>
                    <td>5</td>
                </tr>

                <tr>
                    <td>Dark</td>
                    <td>5</td>
                    <td>1</td>
                </tr>

                <tr>
                    <td>Lost</td>
                    <td>8</td>
                    <td>5</td>
                </tr>

                <tr>
                    <td>Dragon Ball Z</td>
                    <td>50</td>
                    <td>4</td>
                </tr>

                <tr>
                    <td>Naruto</td>
                    <td>51</td>
                    <td>2</td>
                </tr>
                
            </tbody>
        </table>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
    $('#example').DataTable({
        "pagingType": "full_numbers",
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50],
        "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
    });
});
 </script>
*/ 
?>
<div class="container m3">
    <h1 class="tableTitle">Lista de séries</h1>
    <div class="table-container">
        <div class="table">
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
                    <tr>
                        <td>Game of Thrones</td>
                        <td>5</td>
                        <td>2</td>
                        <td>
                            <button class="edit-btn">Editar</button>
                            <button class="delete-btn">Deletar</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Game of Thrones</td>
                        <td>5</td>
                        <td>2</td>
                        <td>
                            <button class="edit-btn">Editar</button>
                            <button class="delete-btn">Deletar</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Game of Thrones</td>
                        <td>5</td>
                        <td>2</td>
                        <td>
                            <button class="edit-btn">Editar</button>
                            <button class="delete-btn">Deletar</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Game of Thrones</td>
                        <td>5</td>
                        <td>2</td>
                        <td>
                            <button class="edit-btn">Editar</button>
                            <button class="delete-btn">Deletar</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Game of Thrones</td>
                        <td>5</td>
                        <td>2</td>
                        <td>
                            <button class="edit-btn">Editar</button>
                            <button class="delete-btn">Deletar</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Game of Thrones</td>
                        <td>5</td>
                        <td>2</td>
                        <td>
                            <button class="edit-btn">Editar</button>
                            <button class="delete-btn">Deletar</button>
                        </td>
                    </tr>
        
                </tbody>
            </table>
        </div>
        
</div>

</x-layout>