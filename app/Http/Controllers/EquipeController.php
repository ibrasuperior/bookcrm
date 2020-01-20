<?php

namespace App\Http\Controllers;
use App\Equipe;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EquipeController extends Controller
{
    public function index()
    {
        $equipes = Equipe::get();
        return view('equipes.index')->with('equipes',$equipes);
    }

   
    public function create()
    {
        return view('equipes.novo');
    }

    
    public function store(Request $request)
    {
        $equipe = new Equipe;
        $equipe->nome = $request->input('nome');
        $equipe->save();
        
        return redirect('/equipes')->with('success',"Cadastrado com sucesso!");
    }
  
    public function edit($id)
    {
        return view('equipes.edit', ['equipe' => Equipe::findOrFail($id)]);
    }
    

    public function update(Request $request, Equipe $equipe)
    {
        $equipe->nome = $request->input('nome');
        $equipe->update();
        return redirect('/equipes')->with("success","Alterado com sucesso!");

    }

    public function destroy(Equipe $equipe,Request $request)
    {
        $id = $request->input('id');
        $user = User::where('equipe_id', $request->input('id') )->get();
        $equipe->where('id',$id);

        if( $user->count() > 0 ){
            return redirect('/equipes')->with('danger',"Existe Usuário nessa equipe!");
        }else{
            $equipe->delete();
            return redirect('/equipes')->with('success',"Excluído com sucesso!");
        }
    }
}