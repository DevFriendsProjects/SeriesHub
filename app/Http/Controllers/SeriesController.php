<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSeriesRequest;
use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class SeriesController extends Controller
{
    public function home(){
        return view('series.home');
    }
    
    public function index(){
        $series = Series::withCount('seasons')->orderBy('name', 'asc')->paginate(10);

        return view('series.index', compact('series'));
    }

    public function show($id){
        $serie = Series::with('seasons')->findOrFail($id);
        $user = Auth::user();
        $watchedSeasons = $user->watchedSeasons()->pluck('season_id')->toArray();

        return view('series.show', compact('serie', 'watchedSeasons'));
    }

    public function create(){
        return view('series.create');
    }

    public function store(AddSeriesRequest $request){
        $serie = new Series();
        $serie->fill($request->validated());
        $serie->save();

        $seasons_quantity = $request->input('seasons');
        for ($i = 1; $i <= $seasons_quantity; $i++) {
            $season = new Season();
            $season->series_id = $serie->id;
            $season->season_number = $i;
            $season->save();
        }

        return to_route('series.index')->with('success', 'Série criada com sucesso!');
    }

    public function destroy($id){
        $serie = Series::findOrFail($id);
        $serie->delete();

        return to_route('series.index')->with('success', 'Série deletada com sucesso!');
    }

    public function edit(Series $series){
        return view ('series.edit', compact('series'));
    }

    public function update(Series $series, AddSeriesRequest $request){
        $series->update($request->validated());

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' foi atualizada com sucesso.");
    }

    public function seasonsWatched(Request $request, $serieId)
    {
        $user = Auth::user();
        $seasons = $request->input('seasons', []);
        $user->watchedSeasons()->sync($seasons);

        return redirect()->route('series.show', $serieId)->with('success', 'Temporadas assistidas atualizadas!');
    }
}
