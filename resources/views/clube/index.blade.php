@extends('template.app')

@section('nome_tela', 'Clube')

@section('cadastro')
    <div class="container">
        <form class="row" method="POST" action="/clube" enctype="multipart/form-data">
            <div class="form-group col-7">
                <label for="nome" class="form-text">Nome:</label>
                <input value="{{$clube->nome}}" id="nome" name="nome" class="form-control" type="text">
            </div>
            <div class="form-group col-5">
                <label for="escudo" class="form-text">Escudo:</label>
                <input value="{{$clube->escudo}}" id="escudo" name="escudo" class="form-control-file" type="file">
            </div>
            <input type="hidden" id="id" name="id" value="{{$clube->id}}">
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
                    <th>Escudo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($clubes as $clube)
                    <tr> 
                        <td>{{$clube->nome}}</td>
                        <td><img class="img-demo" src="{{asset('storage/'. str_replace('public/', '', $clube->escudo))}}" alt=""></td>
                        <td>
                            <div class="btn-custom-group">
                                <form method="GET" action="/clube/{{$clube->id}}/edit">
                                        @csrf
                                        <button class="btn btn-outline-primary icon btn-circle" type="submit"><i class="material-icons">edit</i></button>
                                </form>
                            </div>
                        </td>
                        
                        <td>
                            <div class="btn-custom-group">
                                <form method="POST" action="/clube/{{$clube->id}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button onclick="return confirm('Você deseja realmente deletar esse clube?')" class="btn btn-outline-danger icon btn-circle" type="submit"><i class="material-icons">delete</i></button>
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
        $('#clubes-link').tab('show');
    })
</script>
@endsection

