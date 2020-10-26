<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jogador;
use App\Models\Clube;
use App\Models\Posicao;

class JogadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogador = new Jogador();
        $jogadores = DB::table('jogador AS j')
            ->join('clube AS c', 'c.id', '=', 'j.id_clube')
            ->join('posicao AS p', 'p.id', '=', 'j.id_posicao')
            ->select('j.id', 'j.nome', 'j.data_nasc', 'c.nome AS clube', 'c.escudo as escudo', 'p.nome AS posicao', 'j.is_possui')
            ->get();
        $clubes = Clube::all();
        $posicoes = Posicao::all();
        return view("jogador.index", [
            "jogador" => $jogador,
            "jogadores" => $jogadores,
            "clubes" => $clubes,
            "posicoes" => $posicoes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacao = $request->validate(
            [
                'nome' => 'required',
                'data_nasc' => 'required|date|before:now',
                'clube' => 'required',
                'posicao' => 'required',
                'possui' => 'required',
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'data_nasc.required' => 'A data de nascimento é obrigatório',
                'clube.required' => 'O clube é obrigatório',
                'posicao.required' => 'A posição é obrigatório',
                'possui.required' => 'Você já possui?',
                'data_nasc.before' => 'A data deve ser menor do que a data atual'
            ]
        );

        if ($request->post('id') == '') {
            $jogador = new Jogador();
        } else {
            $jogador = Jogador::find($request->post('id'));
        }

        $jogador->nome = $request->post('nome');
        $jogador->data_nasc = $request->post('data_nasc');
        $jogador->id_clube = $request->post('clube');
        $jogador->id_posicao = $request->post('posicao');
        $jogador->is_possui = $request->input('possui');
        $jogador->save();
        $request->session()->flash('salvar', 'Jogador salvo com sucesso!');
        return redirect('/jogador');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jogador = Jogador::find($id);
        $jogadores = DB::table('jogador AS j')
            ->join('clube AS c', 'c.id', '=', 'j.id_clube')
            ->join('posicao AS p', 'p.id', '=', 'j.id_posicao')
            ->select('j.id', 'j.nome', 'j.data_nasc', 'c.nome AS clube', 'c.escudo as escudo', 'p.nome AS posicao', 'j.is_possui')
            ->get();
        $clubes = Clube::all();
        $posicoes = Posicao::all();
        return view("jogador.index", [
            "jogador" => $jogador,
            "jogadores" => $jogadores,
            "clubes" => $clubes,
            "posicoes" => $posicoes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('jogador')
            ->where('id', '=', $id)
            ->update(['is_possui' => true]);
        return redirect('/jogador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Jogador::destroy($id);
        $request->session()->flash('excluir', "Jogador excluido com sucesso!");
        return redirect('/jogador');
    }
}
