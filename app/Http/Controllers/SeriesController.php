<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSeriesRequest;
use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    // Função para exibir a página principal
    public function home() {
        $seriesCount = Series::count(); // Conta a quantidade de séries
        $usersCount = User::count(); // Conta a quantidade de usuários

        // Retorna a view 'home' com os dados
        return view('series.home', compact('seriesCount', 'usersCount'));
    }
    
    // Função para exibir a página de listar séries
    public function index(){
        $user = Auth::user();  // Pega o usuário logado da sessão atual

        // Carrega as séries com a contagem de temporadas e as temporadas assistidas pelo usuário atual
        $series = Series::withCount('seasons') // Conta o número de temporadas por série
            ->with(['seasons' => function($query) use ($user) {
                // Filtra as temporadas assistidas pelo usuário logado
                $query->whereHas('users', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            }])
            ->orderBy('name', 'asc') // Ordena as séries por nome em ordem ascendente
            ->paginate(10); // Caso necessário, divide a lista total em páginas de 10 séries por página
    
        return view('series.index', compact('series')); // Retorna a view com os dados das séries
    }

    // Função para mostrar os detalhes de uma série e suas temporadas
    public function show($id)
    {
        // Procura a série pelo ID junto com suas temporadas
        $serie = Series::with(['seasons' => function ($query) {
            $query->orderBy('season_number', 'asc');
        }])->findOrFail($id); // Caso não encontre a série, retorna um erro

        $user = Auth::user(); // Pega o usuário logado da sessão atual
        $watchedSeasons = $user->watchedSeasons()->pluck('season_id')->toArray(); // Busca as temporadas assistidas pelo usuário
    
        return view('series.show', compact('serie', 'watchedSeasons')); // Retorna a view com a série e as temporadas assistidas
    }

    // Função para exibir o formulário de crianção de uma nova série
    public function create(){
        return view('series.create');
    }

    // Função que salva uma nova série e suas temporadas no banco de dados
    public function store(AddSeriesRequest $request){
        $serie = new Series();
        $serie->fill($request->validated()); // Preenche os dados da série com base na validação do request
        $serie->save(); // Salva a série no banco de dados

        // Cria as temporadas para a série
        $seasons_quantity = $request->input('seasons'); // Quantidade de temporadas
        for ($i = 1; $i <= $seasons_quantity; $i++) {
            $season = new Season();
            $season->series_id = $serie->id; // Associa a temporada a série criada
            $season->season_number = $i; // Define o número da temporada
            $season->save(); // Salva a temporada
        }

        // Redireciona para a lista de séries com uma mensagem de sucesso
        return to_route('series.index')->with('success', 'Série criada com sucesso!');
    }

    // Função para deletar uma série
    public function destroy($id){
        $serie = Series::findOrFail($id); // Busca a série ou retorna um erro caso não encontre
        $serie->delete(); // Deleta a série do banco de dados

        // Redireciona para a lista de séries com uma mensagem de sucesso
        return to_route('series.index')->with('success', 'Série deletada com sucesso!');
    }

    // Função para exibir o formulário para editar uma série
    public function edit(Series $series){
        return view('series.edit', compact('series'));
    }

    // Função que atualiza uma série e suas temporadas
    public function update(Series $series, AddSeriesRequest $request)
    {
        $series->update($request->validated()); // Atualiza os dados da série com base na validação do request
        $series->seasons()->delete(); // Limpa as temporadas do usuário, deletando as atuais daquela série

        // Cria novas temporadas para a série
        for ($i = 1; $i <= $request->input('seasons'); $i++) {
            $series->seasons()->create([
                'season_number' => $i // Define o número da temporada
            ]);
        }

        // Redireciona para a lista de séries com uma mensagem de sucesso
        return redirect()->route('series.index')->with('success', "Série '{$series->name}' foi atualizada com sucesso!");
    }

    // Função que gerencia as temporadas assistidas pelo usuário
    public function seasonsWatched(Request $request, Series $series)
    {
        $user = Auth::user(); // Obtém o usuário logado

        // Armazena o id da série do formulário
        $series_id = $request->input('series_id');
        
        // Armazena as temporadas marcadas como assistidas do formulário
        $watchedSeasons = $request->input('seasons', []);
        
        // Armazena as temporadas atualmente assistidas pelo usuário da série específica
        $currentWatchedSeasons = $user->watchedSeasons()
            ->whereHas('series', function($query) use ($series_id) {
                $query->where('seasons.series_id', $series_id); // Filtra pelas temporadas da série específica
            })
            ->pluck('season_id')
            ->toArray();

        // Identifica as temporadas que foram desmarcadas
        $seasonsToDetach = array_diff($currentWatchedSeasons, $watchedSeasons);
        // Identifica as temporadas recém-marcadas como assistidas
        $seasonsToAttach = array_diff($watchedSeasons, $currentWatchedSeasons);

        // Remove as temporadas que vieram como desmarcadas do formulário (checkbox)
        if (!empty($seasonsToDetach)) {
            $user->watchedSeasons()
                ->whereIn('season_id', $seasonsToDetach)
                ->whereHas('series', function($query) use ($series_id) {
                    $query->where('seasons.series_id', $series_id); // Remove temporadas da série específica
                })
                ->detach($seasonsToDetach); // Remove as temporadas
        }

        // Adiciona as temporadas novas que foram marcadas
        if (!empty($seasonsToAttach)) {
            foreach ($seasonsToAttach as $seasonId) {
                $user->watchedSeasons()->attach($seasonId, ['series_id' => $series_id]); // Adiciona as temporadas e o series_id
            }
        }

        // Redireciona para a página da série com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Temporadas assistidas atualizadas com sucesso.');
    }
}