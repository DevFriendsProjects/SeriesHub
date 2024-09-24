<x-layout title="Series - Home">

    <div class="addseries col-md-10 ml-sm-auto col-lg-11 px-4">
        <h1 class="tableTitle">SeriesHub</h1>
        <div class="card-info">
            <div class="series-cad">
                <h3>Séries cadastradas:</h3>
                <p class="h5">{{ $seriesCount }}</p>
            </div>
            <div class="usuario-cad">
                <h3>Usuários cadastrados:</h3>
                <p class="h5">{{ $usersCount }}</p>
            </div>
        </div>
    </div>

</x-layout>