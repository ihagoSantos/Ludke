<?php

namespace App\Http\Controllers;
use App\Funcionario;
use App\User;
use App\Endereco;
use App\Telefone;
use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Retorna a view dos funcionarios
    public function indexView()
    {
        $clientes = Cliente::paginate(10);
        #$fun = \App\Funcionario::where('cargo_id', '=', 3)
         #   ->join('users', 'funcionarios.user_id', '=', 'users.id')->get();
        $fun = Funcionario::with('user')->get();
        #dd($fun);
        return view('cliente',["clientes"=>$clientes,'fun'=>$fun]);
    }

    public function buscarCliente(Request $request){
        $c =  strtoupper($request->input('q'));
        // dd($c);

        if(isset($c)){
            $users = User::where('name','LIKE','%'.$c.'%')->pluck('id');
            $clientes = Cliente::whereIn('user_id',$users)->paginate(10)->setpath('');
            $fun = Funcionario::with('user')->where('cargo_id',3)->get();

            // dd($clientes);

            // ->paginate(10)->setpath('');
            $clientes->appends(array('q'=>$request->input('q')));
            if(count($clientes) > 0){
                // dd($cargos);
                return view('cliente',['clientes'=>$clientes, 'fun'=>$fun,'achou'=> true]);
            }else{
                return view('cliente',['fun'=>$fun])->withMenssage("Desculpa, não foi possível encontrar este cliente.");
            }
        }

    }
    public function index()
    {
        $clientes = Cliente::all();
        $arrayClientes = Array();
        foreach($clientes as $c){
            $user = User::where('id',$c->user_id)->first();
            $endereco = Endereco::where('id',$user->endereco_id)->first();
            $telefone = Telefone::where('id',$user->telefone_id)->first();

            $cli = [
                'id' => $c->id,
                'nome'=> $user->name,
                'email' => $user->email,
                'nomeReduzido' => $c->nomeReduzido,
                'nomeResponsavel' => $c->nomeResponsavel,
                'cpfCnpj' => $c->cpfCnpj,
                'tipo' => $c->tipo,
                'funcionario_id' => $c->funcionario_id,
                'inscricaoEstadual' => $c->inscricaoEstadual,
                'residencial' => $telefone->residencial,
                'celular' => $telefone->celular,
                'cep' => $endereco->cep,
                'rua' => $endereco->rua,
                'bairro' => $endereco->bairro,
                'cidade' => $endereco->cidade,
                'uf' => $endereco->uf,
                'numero' => $endereco->numero,
                'complemento' => $endereco->complemento,
            ];

            array_push($arrayClientes,$cli);
        }

        return json_encode($arrayClientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validation = $this->validate($request,[
                'nome'=> 'required|string|min:5|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'nomeReduzido' => 'nullable|string|max:255',
                'nomeResponsavel' => 'nullable|string|max:255',
                'cpfCnpj' => 'required|unique:clientes',
                'tipo' => 'required',
                'inscricaoEstadual' => 'nullable|string|max:255',
                'residencial' => 'nullable|string',
                'celular' => 'nullable|string',
                'cep' => 'nullable|string',
                'rua' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required',
                'numero' => 'required|string',
                'complemento' => 'nullable|string',
        ]);

        // ENDERECO
        $endereco = new Endereco();
        //dd($endereco);
        $endereco->rua = strtoupper($request->input('rua'));
        $endereco->numero = $request->input('numero');
        $endereco->bairro = strtoupper($request->input('bairro'));
        $endereco->cidade = strtoupper($request->input('cidade'));
        $endereco->uf = strtoupper($request->input('uf'));
        $endereco->cep = $request->input('cep');
        $endereco->complemento = strtoupper($request->input('complemento'));
        $endereco->save();

        // TELEFONE
        $telefone = new Telefone();
        $telefone->residencial = $request->input('residencial');
        $telefone->celular = $request->input('celular');
        $telefone->save();

        // USER
        $user = new User();
        $senhaAutomatica = bcrypt('123456');
        $user->name = strtoupper($request->input('nome'));
        $user->tipo = 'cliente';
        $user->email= $request->input('email');
        $user->password = $senhaAutomatica;
        $user->endereco_id = $endereco->id;
        $user->telefone_id = $telefone->id;
        $user->save();

        // CLIENTE
        $cliente = new Cliente();
        $cliente->nomeReduzido = strtoupper($request->input('nomeReduzido'));
        $cliente->nomeResponsavel = strtoupper($request->input('nomeResponsavel'));
        $cliente->cpfCnpj = $request->input('cpfCnpj');
        $cliente->funcionario_id = $request->input('funcionario_id');

        $cliente->tipo = $request->input('tipo');
        $cliente->inscricaoEstadual = strtoupper($request->input('inscricaoEstadual'));
        $cliente->user_id = $user->id;
        $cliente->save();

        $cli = [
            'id' => $cliente->id,
            'nome'=> $user->name,
            'email' => $user->email,
            'nomeReduzido' => $cliente->nomeReduzido,
            'nomeResponsavel' => $cliente->nomeResponsavel,
            'cpfCnpj' => $cliente->cpfCnpj,
            'tipo' => $cliente->tipo,
            'inscricaoEstadual' => $cliente->inscricaoEstadual,
            'residencial' => $telefone->residencial,
            'celular' => $telefone->celular,
            'cep' => $endereco->cep,
            'rua' => $endereco->rua,
            'bairro' => $endereco->bairro,
            'cidade' => $endereco->cidade,
            'uf' => $endereco->uf,
            'numero' => $endereco->numero,
            'complemento' => $endereco->complemento,
        ];



        #return json_encode($cli);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $cliente = Cliente::find($id);
        $user = User::find($cliente->user_id);
        $telefone = Telefone::find($user->telefone_id);
        $endereco = Endereco::find($user->endereco_id);

        if(isset($cliente) && isset($user)
        && isset($telefone) && isset($endereco)){
            $cli = [
                'id' => $cliente->id,
                'nome'=> $user->name,
                'email' => $user->email,
                'nomeReduzido' => $cliente->nomeReduzido,
                'nomeResponsavel' => $cliente->nomeResponsavel,
                'cpfCnpj' => $cliente->cpfCnpj,
                'tipo' => $cliente->tipo,
                'funcionario_id'=>$cliente->funcionario_id,
                'inscricaoEstadual' => $cliente->inscricaoEstadual,
                'residencial' => $telefone->residencial,
                'celular' => $telefone->celular,
                'cep' => $endereco->cep,
                'rua' => $endereco->rua,
                'bairro' => $endereco->bairro,
                'cidade' => $endereco->cidade,
                'uf' => $endereco->uf,
                'numero' => $endereco->numero,
                'complemento' => $endereco->complemento,
            ];

            return json_encode($cli);
        }
        else{
            return response('Cliente não encontrado',404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $cliente = Cliente::find($id);
        $user = User::find($cliente->user_id);
        $telefone = Telefone::find($user->telefone_id);
        $endereco = Endereco::find($user->endereco_id);

        if($user->email != $request->input('email') && $cliente->cpfCnpj != $request->input('cpfCnpj')){
            $validation = $this->validate($request,[
                'nome'=> 'required|string|min:5|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'nomeReduzido' => 'nullable|string|max:255',
                'nomeResponsavel' => 'nullable|string|max:255',
                'cpfCnpj' => 'required|unique:clientes',
                'tipo' => 'required',
                'inscricaoEstadual' => 'nullable|string|max:255',
                'residencial' => 'nullable|string',
                'celular' => 'nullable|string',
                'cep' => 'nullable|string',
                'rua' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required',
                'numero' => 'required|string',
                'complemento' => 'nullable|string',
            ]);
        }
        if($user->email == $request->input('email') && $cliente->cpfCnpj != $request->input('cpfCnpj')){
            $validation = $this->validate($request,[
                'nome'=> 'required|string|min:5|max:255',
                // 'email' => 'required|string|email|max:255|unique:users',
                'nomeReduzido' => 'nullable|string|max:255',
                'nomeResponsavel' => 'nullable|string|max:255',
                'cpfCnpj' => 'required|unique:clientes',
                'tipo' => 'required',
                'inscricaoEstadual' => 'nullable|string|max:255',
                'residencial' => 'nullable|string',
                'celular' => 'nullable|string',
                'cep' => 'nullable|string',
                'rua' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required',
                'numero' => 'required|string',
                'complemento' => 'nullable|string',
            ]);
        }
        if($user->email != $request->input('email') && $cliente->cpfCnpj == $request->input('cpfCnpj')){
            $validation = $this->validate($request,[
                'nome'=> 'required|string|min:5|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'nomeReduzido' => 'nullable|string|max:255',
                'nomeResponsavel' => 'nullable|string|max:255',
                // 'cpfCnpj' => 'required|unique:clientes',
                'tipo' => 'required',
                'inscricaoEstadual' => 'nullable|string|max:255',
                'residencial' => 'nullable|string',
                'celular' => 'nullable|string',
                'cep' => 'nullable|string',
                'rua' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required',
                'numero' => 'required|string',
                'complemento' => 'nullable|string',
            ]);
        }
        else{
            $validation = $this->validate($request,[
                'nome'=> 'required|string|min:5|max:255',
                // 'email' => 'required|string|email|max:255|unique:users',
                'nomeReduzido' => 'nullable|string|max:255',
                'nomeResponsavel' => 'nullable|string|max:255',
                // 'cpfCnpj' => 'required|unique:clientes',
                'tipo' => 'required',
                'inscricaoEstadual' => 'nullable|string|max:255',
                'residencial' => 'nullable|string',
                'celular' => 'nullable|string',
                'cep' => 'nullable|string',
                'rua' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required',
                'numero' => 'required|string',
                'complemento' => 'nullable|string',
            ]);
        }


        if(isset($cliente) && isset($user)
        && isset($telefone) && isset($endereco)){
            // ENDERECO
            $endereco->rua = strtoupper($request->input('rua'));
            $endereco->numero = $request->input('numero');
            $endereco->bairro = strtoupper($request->input('bairro'));
            $endereco->cidade = strtoupper($request->input('cidade'));
            $endereco->uf = strtoupper($request->input('uf'));
            $endereco->cep = $request->input('cep');
            $endereco->complemento = strtoupper($request->input('complemento'));
            $endereco->save();

            // TELEFONE
            $telefone->residencial = $request->input('residencial');
            $telefone->celular = $request->input('celular');
            $telefone->save();

            // USER
            $user->name = strtoupper($request->input('nome'));
            $user->email= $request->input('email');
            $user->save();

            // CLIENTE
            $cliente->nomeReduzido = strtoupper($request->input('nomeReduzido'));
            $cliente->nomeResponsavel = strtoupper($request->input('nomeResponsavel'));
            $cliente->cpfCnpj = $request->input('cpfCnpj');
            $cliente->tipo = $request->input('tipo');
            $cliente->inscricaoEstadual = strtoupper($request->input('inscricaoEstadual'));
            $cliente->funcionario_id = $request->input('funcionario_id');
            $cliente->save();

            $cli = [
                'id' => $cliente->id,
                'nome'=> $user->name,
                'email' => $user->email,
                'nomeReduzido' => $cliente->nomeReduzido,
                'nomeResponsavel' => $cliente->nomeResponsavel,
                'cpfCnpj' => $cliente->cpfCnpj,
                'tipo' => $cliente->tipo,
                'inscricaoEstadual' => $cliente->inscricaoEstadual,
                'residencial' => $telefone->residencial,
                'celular' => $telefone->celular,
                'cep' => $endereco->cep,
                'rua' => $endereco->rua,
                'bairro' => $endereco->bairro,
                'cidade' => $endereco->cidade,
                'uf' => $endereco->uf,
                'numero' => $endereco->numero,
                'complemento' => $endereco->complemento,
            ];

            return json_encode($cli);
        }else{
            return response('Cliente não encontrado',404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cliente = Cliente::find($id);
        $user = User::find($cliente->user_id);
        $telefone = Telefone::find($user->telefone_id);
        $endereco = Endereco::find($user->endereco_id);
        if(isset($cliente)){
            $cliente->delete();
            $user->delete();
            $telefone->delete();
            $endereco->delete();
            return response('OK',200);
        }
        return resonse('Cliente não encontrado', 404);
    }


    public function relatorioCliente(){
        $view = 'relatorioCliente';
        $clientes = Cliente::select('nomeResponsavel','cpfCnpj', 'nomeReduzido')->get();




        #$dadoClientes = Cliente::with('user')->get();
        #dd($dadoClientes);
        #$cliente_id = Cliente::select('user_id');
        #$endereco = Endereco::where()
        #dd($clientes);




        $date = date('d/m/Y');
        $view = \View::make($view, compact('clientes',  'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');

        $filename = 'relatorioCliente'.$date;


        return $pdf->stream($filename.'.pdf');

    }

}
