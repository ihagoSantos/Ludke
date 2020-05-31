@section('date',$date)
@section('content')
@section('titulo','Relatório dos Pedidos')
@extends('layouts.relatorios')

<div class="row justify-content-center">
    <div class="col-sm-12">
        <table id="tabelaClientes" class="table table-borderless table-striped" style="width: 100vw">
            <thead class="thead-primary" style="background-color: #BF1A2C;color: white;">
            <tr style="height:20px">
                <th>Código</th>
                <th>Nome Cliente</th>
                <th>Nome Reduzido</th>
                <th>Vendedor</th>
                <th>Data de Entrega</th>
                <th>Pedido</th>
                <th>Status</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $pedido)
                <tr align="center">
                    <td>{{$pedido->id}}</td>
                    <td >{{$pedido->cliente->user->name}}</td>
                    <td >{{$pedido->cliente->nomeReduzido}}</td>
                    <td>{{$pedido->funcionario->user->name}}</td>
                    <td>{{date('d/m/Y',strtotime($pedido->dataEntrega))}}</td>
                    <td>
                        <ul>
                            @foreach ($pedido->itensPedidos as $itens)
                            <li>{{$itens->nomeProduto}} | {{$itens->pesoSolicitado}} KG</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{$pedido->status->status}}</td>
                    <td>{{$pedido->valorTotal = number_format($pedido->valorTotal, '2',',','.').' R$'}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <table  id="tabelaClientes" class="table table-borderless table-striped" style="width: 100vw">
            <thead class="thead-primary" style="background-color: #BF1A2C;color: white;">
            <tr style="height:20px">
                <th>Número total de pedidos</th>
            </tr>
            </thead>
            <tr align="center">
                <td>{{$count}}</td>
            </tr>
        </table>
        <table  id="tabelaClientes" class="table table-borderless table-striped" style="width: 100vw">
            <thead class="thead-primary" style="background-color: #BF1A2C;color: white;">
            <tr style="height:20px">
                <th>Valor total dos Pedidos</th>
            </tr>
            </thead>
            <tr align="center">
                <td>{{$total = number_format($total, '2',',','.').' R$'}}</td>
            </tr>
        </table>

    </div>
</div>

@stop