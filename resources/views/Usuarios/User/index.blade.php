@extends('usuarios.layouts.app')

@section('content')
<ul class="list-group">
  <li class="list-group-item"><h4 class="text-center">Upload de Arquivos</h3></li>
    <li class="list-group-item">
      <a href="{!! url('/painel') !!}">Painel</a> -> upload de arquivos
    </li>
</ul>

<div class="row">
  <div class="col-md-12">

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  @if(session('mensagem'))
  <div class="alert alert-success">{{session('mensagem')}}</div>
  @endif

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Gerenciar Tags</h3>
      </div>
      <div class="panel-body">
        @if(Auth::user()->level >= 2)
          <form class="" action="{{url()->current()}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <label>Nome</label>
              <input type="text" class="form-control" name="nome">
            </div>
            <div class="form-group">
              <input type="file" name="arquivo">
            </div>
            <button type="submit" class="btn btn-success">Adicionar</button>
          </form>
        @else
          <p>Você não tem permissão.</p>
        @endif
      </div>
      <div class="panel-footer" style="padding:0px;">
        <table class="table">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th></th>
          </tr>
            @foreach($arquivos as $arquivo)
            <tr>
              <td>{{$arquivo->id}}</td>
              <td>{{$arquivo->nome}}</td>
              <td>{{$arquivo->tipo}}</td>
              <td>
                @if(Auth::user()->level >= 2)
                  <a onclick="" class="btn btn-sm btn-warning">Editar</a>
                  <a href="" class="btn btn-sm btn-danger">Deletar</a>
                @else
                  Você não tem permissão.
                @endif
              </td>
            </tr>
            @endforeach
        </table>
      </div>
    </div>

  </div>
</div>
