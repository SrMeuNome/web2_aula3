<?php

namespace App\Http\Controllers;

use App\Models\Jogador;
use Illuminate\Http\Request;
use App\Models\Posicao;

class PosicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posicao = new Posicao();
        $posicoes = Posicao::all();
        return view("posicao.index", [
            "posicao" => $posicao,
            "posicoes" => $posicoes
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
                'descricao' => 'required'
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'descricao.required' => 'A descricao é obrigatório'
            ]
        );

        if ($request->post('id') == '') {
            $posicao = new Posicao();
        } else {
            $posicao = Posicao::find($request->post('id'));
        }
        $posicao->nome = $request->post('nome');
        $posicao->descricao = $request->post('descricao');
        $posicao->save();
        $request->session()->flash('salvar', 'Descrição editada com sucesso!');
        return redirect('/posicao');
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
        $posicao = Posicao::find($id);
        $posicoes = Posicao::all();
        return view("posicao.edit", [
            "posicao" => $posicao,
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    }
}
