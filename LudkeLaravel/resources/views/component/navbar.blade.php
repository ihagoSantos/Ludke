
<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home')}}">
            <img id="logo" src="{{asset('img/logo_navbar.png')}}" style="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            {{-- @if(Auth::check()) --}}
            @can('view_admin', Auth::user())
                <ul class="navbar-nav mr-auto">
                    {{-- Inicio --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Início</a>
                    </li>
                    {{-- Cruds --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gerenciar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('produtos')}}">Produtos</a>
                            <a class="dropdown-item" href="{{route('categorias')}}">Categorias</a>
                            <a class="dropdown-item" href="{{route('clientes')}}">Clientes</a>
                            <a class="dropdown-item" href="{{route('funcionarios')}}">Funcionários</a>
                            <a class="dropdown-item" href="{{route('cargos')}}">Cargos</a>
                        </div>
                    </li>
                    {{-- Pedidos --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pedidos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('pedidos')}}">Novo Pedido</a>
                            <a class="dropdown-item" href="{{route('listarPedidos')}}">Listar Pedidos</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item">

                        <a class="nav-link" href="{{route('listarPedidos')}}">Pedidos</a>
                    </li> --}}
                    {{-- Vendas --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Vendas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendas')}}">Nova Venda</a>
                            <a class="dropdown-item" href="{{route('listarVendas')}}">Listar Vendas</a>
                        </div>
                    </li>
                    {{-- Relatórios --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Relatórios
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('relatorioCliente')}}" target="_blank">Clientes</a>
                            <a class="dropdown-item" href="{{route('relatorioProdutos')}}" target="_blank" >Produtos</a>
                            <a class="dropdown-item" href="{{route('relatorioGeralPedidos')}}" target="_blank">Pedidos</a>
                        </div>




                    </li>
                    {{-- Ajuda --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>
            @endcan


            @can('view_gerenteAdmin', Auth::user())
                <ul class="navbar-nav mr-auto">
                    {{-- Inicio --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Início</a>
                    </li>
                    {{-- Cruds --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gerenciar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('produtos')}}">Produtos</a>
                            <a class="dropdown-item" href="{{route('categorias')}}">Categorias</a>
                            <a class="dropdown-item" href="{{route('clientes')}}">Clientes</a>
                            <a class="dropdown-item" href="{{route('funcionarios')}}">Funcionários</a>
                            <a class="dropdown-item" href="{{route('cargos')}}">Cargos</a>
                        </div>
                    </li>
                    {{-- Pedidos --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pedidos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('pedidos')}}">Novo Pedido</a>
                            <a class="dropdown-item" href="{{route('listarPedidos')}}">Listar Pedidos</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item">

                        <a class="nav-link" href="{{route('listarPedidos')}}">Pedidos</a>
                    </li> --}}
                    {{-- Vendas --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Vendas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendas')}}">Nova Venda</a>
                            <a class="dropdown-item" href="{{route('listarVendas')}}">Listar Vendas</a>
                        </div>
                    </li>
                    {{-- Relatórios --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Relatórios
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('relatorioCliente')}}" target="_blank">Clientes</a>
                            <a class="dropdown-item" href="{{route('relatorioProdutos')}}" target="_blank" >Produtos</a>
                            <a class="dropdown-item" href="{{route('relatorioGeralPedidos')}}" target="_blank" >Produtos</a>

                        </div>




                    </li>
                    {{-- Ajuda --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>
        @endcan


            @can('view_vendedor', Auth::user())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Início</a>
                    </li>
                    <li class="nav-item dropdown">

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('produtos')}}">Produtos</a>
                            <a class="dropdown-item" href="{{route('categorias')}}">Categorias</a>
                            <a class="dropdown-item" href="{{route('clientes')}}">Clientes</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('listarPedidos')}}">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Relatórios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>
        @endcan

            @can('view_salsicheiro', Auth::user())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Início</a>
                    </li>
                    <li class="nav-item dropdown">

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('produtos')}}">Produtos</a>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('listarPedidos')}}">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>
        @endcan

            @can('view_gerenteGeral', Auth::user())
                <ul class="navbar-nav mr-auto">
                    {{-- Inicio --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Início</a>
                    </li>
                    {{-- Cruds --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gerenciar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('produtos')}}">Produtos</a>
                            <a class="dropdown-item" href="{{route('categorias')}}">Categorias</a>
                            <a class="dropdown-item" href="{{route('clientes')}}">Clientes</a>
                            <a class="dropdown-item" href="{{route('funcionarios')}}">Funcionários</a>
                            <a class="dropdown-item" href="{{route('cargos')}}">Cargos</a>
                        </div>
                    </li>
                    {{-- Pedidos --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pedidos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('pedidos')}}">Novo Pedido</a>
                            <a class="dropdown-item" href="{{route('listarPedidos')}}">Listar Pedidos</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item">

                        <a class="nav-link" href="{{route('listarPedidos')}}">Pedidos</a>
                    </li> --}}
                    {{-- Vendas --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Vendas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendas')}}">Nova Venda</a>
                            <a class="dropdown-item" href="{{route('listarVendas')}}">Listar Vendas</a>
                        </div>
                    </li>
                    {{-- Relatórios --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Relatórios
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('relatorioCliente')}}" target="_blank">Clientes</a>
                            <a class="dropdown-item" href="{{route('relatorioProdutos')}}" target="_blank" >Produtos</a>
                            <a class="dropdown-item" href="{{route('relatorioGeralPedidos')}}" target="_blank" >Produtos</a>


                        </div>




                    </li>
                    {{-- Ajuda --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>
             @endcan


            @can('view_secretaria', Auth::user())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Início</a>
                    </li>
                    <li class="nav-item dropdown">

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('produtos')}}">Produtos</a>
                            <a class="dropdown-item" href="{{route('categorias')}}">Categorias</a>
                            <a class="dropdown-item" href="{{route('clientes')}}">Clientes</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('listarPedidos')}}">Pedidos</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Vendas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendas')}}">Nova Venda</a>
                            <a class="dropdown-item" href="{{route('listarVendas')}}">Listar Vendas</a>
                        </div>
                    </li>
                    {{-- Relatórios --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownGerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Relatórios
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('relatorioCliente')}}" target="_blank">Clientes</a>
                            <a class="dropdown-item" href="{{route('relatorioProdutos')}}" target="_blank">Produtos</a>
                            <a class="dropdown-item" href="{{route('relatorioGeralPedidos')}}" target="_blank">Pedidos</a>
                        </div>


                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>
        @endcan
            {{-- @endif --}}
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@can('view_admin', Auth::user())
{{-- Modal Filtro Relatório Produtos --}}
<div class="modal fade" id="filtroRelatorioPedidos" tabindex="-1" role="dialog" aria-labelledby="filtroRelatorioProdutoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gerar Relatório de pedidos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="relatorioGeralPedidos" action="{{route('relatorioGeralPedidos')}}" method="POST" target="_blanck">
        <div class="modal-body">
            <div class="alert alert-secondary" role="alert">
                Para gerar o relatório com todas as informações, deixe o <strong>filtro</strong> em branco!
              </div>
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="cliente">Nome do Cliente</label>
                        <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nome do Cliente">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="cliente">Nome Reduzido</label>
                        <input type="text" class="form-control" id="nomeReduzido" name="nomeReduzido" placeholder="Nome Reduzido">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="dataEntregaInicial">Data de Entrega Inicial</label>
                        <input type="date" class="form-control" id="dataEntregaInicial" name="dataEntregaInicial">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="dataEntregaFinal">Data de Entrega Final</label>
                        <input type="date" class="form-control" id="dataEntregaFinal" name="dataEntregaFinal">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="status_id">Status</label>
                        <select class="form-control" name="status_id" id="status_id">
                            <option value="" disabled selected>-- STATUS --</option>
                            <option value="1">SOLICITADO</option>
                            <option value="2">PESADO</option>
                            <option value="3">ENTREGUE</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="entregador">Entregador</label>
                        <select class="form-control" name="entregador" id="entregador">
                            <option value="" disabled selected>-- ENTREGADOR --</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Gerar Relatório</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<script>

    $(document).ready(function(){

        $("#relatorioPedidos").click(function(){
            // Limpa Inputs modal
            $("#cliente").val("");
            $("#nomeReduzido").val("");
            $("#dataEntregaInicial").val("YYYY-MM-DD");
            $("#dataEntregaFinal").val("YYYY-MM-DD");
            $("#status_id").val("");
            $("#entregador").html('<option value="" disabled selected>-- STATUS --</option>');

            // Busca todos os funcionários que podem entregar pedido
            $.getJSON('/getEntregadores', function(entregadores){

                entregadores.forEach(entregador => {
                    $("#entregador").append(`<option value="${entregador.id}">${entregador.user.name}</option>`)
                });
            });
        });
    });

</script>
@endcan
