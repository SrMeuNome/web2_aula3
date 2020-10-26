<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clube;
use Illuminate\Support\Facades\Storage;

class ClubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clube = new Clube();
        $clubes = Clube::all();
        return view("clube.index", [
            "clube" => $clube,
            "clubes" => $clubes
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
                'escudo' => 'required'
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'escudo.required' => 'O escudo é obrigatório'
            ]
        );

        if ($request->post('id') == '') {
            $clube = new Clube();
        } else {
            $clube = Clube::find($request->post('id'));
        }

        if ($request->file('escudo')) {

            if ($clube->escudo != '') {
                Storage::disk('local')->delete($clube->escudo);
            }

            $clube->escudo = $request->file('escudo')->store('public/imagens');
        }
        $clube->nome = $request->post('nome');
        $clube->save();
        $request->session()->flash('salvar', 'Clube salvo com sucesso!');
        return redirect('/clube');
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
        $clube = Clube::find($id);
        $clubes = Clube::all();
        return view("clube.index", [
            "clube" => $clube,
            "clubes" => $clubes,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $clube = Clube::find($id);
        Storage::disk('local')->delete($clube->escudo);
        Clube::destroy($id);
        $request->session()->flash('excluir', "Clube excluido com sucesso!");
        return redirect('/clube');
    }
}
