@section('date',$date)
@section('content')
@section('titulo','Relatório de Produtos')
@extends('layouts.relatorios')

<div class="row justify-content-center">
    <div class="col-sm-12">
        <table id="tabelaClientes" class="table table-borderless table-striped" style="width: 100vw">
            <thead class="thead-primary" style="background-color: #BF1A2C;color: white;">
            <tr style="height:20px">
                <th>ID</th>
                <th>Nome</th>
                <th>Validade - Mês</th>
                <th>Preco</th>
                <th>Categoria</th>
            </tr>
            </thead>
            <tbody>
            @foreach($produtos as $produto)
                <tr align="center">
                    <td>{{$produto->id}}</td>
                    <td >{{$produto->nome}}</td>
                    <td>{{$produto->validade}}</td>
                    <td>{{$produto->preco = number_format($produto->preco, '2',',','.').' R$'}}</td>
                    <td>{{$produto->categoria->nome}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
