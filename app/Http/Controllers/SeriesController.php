<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSeriesRequest;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SeriesController extends Controller
{
    public function home(){
        return view('series.home');
    }
    
    public function index(){
        $series = Series::orderBy('name', 'asc')->paginate(10);

        return view('series.index', compact('series'));
    }

    public function create(){
        return view('series.create');
    }

    public function store(AddSeriesRequest $request){
        $serie = new Series();
        $serie->fill($request->validated());
        $serie->save();

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
}
