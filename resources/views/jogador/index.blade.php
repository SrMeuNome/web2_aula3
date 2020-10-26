@extends('template.app')

@section('nome_tela', 'Jogador')

@section('cadastro')
    <div class="container">
        <form class="row" method="POST" action="/jogador">
            <div class="form-group col-9">
                <label for="nome" class="form-text">Nome do jogador:</label>
                <input value="{{$jogador->nome}}" id="nome" name="nome" class="form-control" type="text">
            </div>
            <div class="form-group col-3">
                <label for="data_nasc" class="form-text">Data de Nascimento:</label>
                <input value="{{$jogador->data_nasc}}" id="data_nasc" name="data_nasc" class="form-control" type="date">
            </div>
            <div class="form-group col-6">
                <label for="clube" class="form-text">Clube:</label>
                <select id="clube" name="clube" class="custom-select">
                    <option></option>
                    @foreach ($clubes as $clube)
                        @if ($clube->id == $jogador->id_clube)
                            <option selected value="{{$clube->id}}">{{$clube->nome}}</option>                            
                        @endif
                        <option value="{{$clube->id}}">{{$clube->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-3">
                <label for="posicao" class="form-text">Posição:</label>
                <select id="posicao" name="posicao" class="custom-select">
                    <option></option>
                    @foreach ($posicoes as $posicao)
                        @if ($posicao->id == $jogador->id_posicao)
                            <option selected value="{{$posicao->id}}">{{$posicao->nome}}</option>                            
                        @endif
                        <option value="{{$posicao->id}}">{{$posicao->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-3 row">
                <label class="form-text col-12">Possui:</label>
                <div class="form-check-inline col-12">
                    @if ($jogador->is_possui)
                        <label class="form-check-label col-5">
                            <input value="1" checked id="possui-sim" name="possui" class="form-check-input" type="radio">Sim
                        </label>
                        <label class="form-check-label col-6">
                            <input value="0" id="possui-nao" name="possui" class="form-check-input" type="radio">Não
                        </label>
                    @else
                        <label class="form-check-label col-5">
                            <input value="1" id="possui-sim" name="possui" class="form-check-input" type="radio">Sim
                        </label>
                        <label class="form-check-label col-6">
                            <input value="0" checked id="possui-nao" name="possui" class="form-check-input" type="radio">Não
                        </label>
                    @endif
                    <input value="{{$jogador->id}}" id="id" name="id" type="hidden">
                </div>
            </div>
            @csrf
            <div class="form-inline col-12 btn-custom-group">
                <button type="submit" class="btn btn-outline-success icon"><i class="material-icons">add_circle_outline</i></button>
                <button type="reset" class="btn btn-outline-warning icon"><i class="material-icons">clear</i></button>
            </div>
        </form>
    </div>
@endsection

@section('listagem')
    <div class="custom-table">
        <table class="table table-hover table-light col-12">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Clube</th>
                    <th>Posição</th>
                    <th>Obter</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($jogadores as $jogador)
                    <tr> 
                        <td>{{$jogador->nome}}</td>
                        <td>{{$jogador->data_nasc}}</td>
                        <td><img class="img-demo" src="{{asset('storage/'. str_replace('public/', '', $jogador->escudo))}}" alt=""></td>
                        <td>{{$jogador->posicao}}</td>
                        <td>
                            <form method="POST" action="/jogador/{{$jogador->id}}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT" />
                                @if ($jogador->is_possui)
                                    <button class="btn btn-outline-dark disabled" disabled type="submit">Adquirido</button>
                                @else
                                    <button class="btn btn-outline-info" type="submit">Adquirir</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <div class="btn-custom-group">
                                <form method="GET" action="/jogador/{{$jogador->id}}/edit">
                                    @csrf
                                    <button class="btn btn-outline-primary icon btn-circle" type="submit"><i class="material-icons">edit</i></button>
                                </form>
                            </div>
                        </td>
                        
                        <td>
                            <div class="btn-custom-group">
                                <form method="POST" action="/jogador/{{$jogador->id}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button onclick="return confirm('Você deseja realmente deletar esse jogador?')" class="btn btn-outline-danger icon btn-circle" type="submit"><i class="material-icons">delete</i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection

@section('tab-active')
<script>
    $(document).ready(function() {
        $('#jogadores-link').tab('show');
    })
</script>
@endsection

