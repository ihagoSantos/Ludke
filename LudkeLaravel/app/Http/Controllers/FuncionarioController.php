<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cargo;
use App\Telefone;
use App\Endereco;
use App\Funcionario;

class FuncionarioController extends Controller
{
    // Retorna a view dos funcionarios
    public function indexView()
    {
        return view('funcionario');
    }

    public function index()
    {
        

        $funcionarios = Funcionario::all();
        $arrayFuncionarios = Array();
        foreach($funcionarios as $f){
            $user = User::where('id',$f->user_id)->first();
            $endereco = Endereco::where('id',$user->endereco_id)->first();
            $telefone = Telefone::where('id',$user->telefone_id)->first();
            $fun = [
                    'id' => $f->id,
                    'email' => $user->email,
                    'nome' => $user->name,
                    'cargo' => $f->cargo_id,
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
            array_push($arrayFuncionarios,$fun);                
        }
        return json_encode($arrayFuncionarios);
        // $funcionario = Funcionario::find(1)->user;
        // return json_encode($funcionario);
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

    
    public function store(Request $request)
    {
        
        // ENDERECO
        $endereco = new Endereco();
        $endereco->rua = $request->input('rua');
        $endereco->numero = $request->input('numero');
        $endereco->bairro = $request->input('bairro');
        $endereco->cidade = $request->input('cidade');
        $endereco->uf = $request->input('uf');
        $endereco->cep = $request->input('cep');
        $endereco->complemento = $request->input('complemento');
        $endereco->save();

        // TELEFONE
        $telefone = new Telefone();
        $telefone->residencial = $request->input('residencial');
        $telefone->celular = $request->input('celular');
        $telefone->save();

        // USER
        $user = new User();
        $senhaAutomatica = bcrypt('123456');
        $user->name = $request->input('nome');
        $user->tipo = 'funcionario';
        $user->email= $request->input('email');
        $user->password = $senhaAutomatica;
        $user->endereco_id = $endereco->id;
        $user->telefone_id = $telefone->id;
        $user->save();

        $funcionario = new Funcionario();
        $funcionario->user_id = $user->id;
        $funcionario->cargo_id = $request->input('cargo');
        $funcionario->save();


        // $user = $user->toArray();
        // $endereco = $endereco->toArray();
        // $telefone = $telefone->toArray();

        $fun = [
            'id' => $funcionario->id,
            'email' => $user->email,
            'nome' => $user->name,
            'cargo' => $funcionario->cargo_id,
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
        // dd($fun);
        // var_dump($fun);
        return json_encode($fun);
        // Response::json(array('user'=>$user, 'endereco'=> $endereco, 'telefone'=>$telefone));
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
