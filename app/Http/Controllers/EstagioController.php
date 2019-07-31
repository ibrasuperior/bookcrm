<?php

namespace App\Http\Controllers;

use App\Estagio;
use Illuminate\Http\Request;

class EstagioController extends Controller
{
    public function index()
    {
        $estagios = Estagio::get();
        return view('estagio.index')->with('estagios',$estagios);
    }

   
    public function create()
    {
        return view('estagio.novo');
    }

    
    public function store(Request $request)
    {
        $estagio = new estagio;
        $estagio->nome = $request->input('nome');
        $estagio->save();
        
        return redirect('/estagio')->with('success',"Cadastrado com sucesso!");
    }

   
    public function show(d $d)
    {
        //
    }


  
    public function edit($id)
    {
        return view('estagio.edit', ['estagio' => Estagio::findOrFail($id)]);
    }
    

    public function update(Request $request, estagio $estagio)
    {
        $estagio->nome = $request->input('nome');
        $estagio->update();
        return redirect('/estagio')->with("success","Alterado com sucesso!");

    }

    public function destroy(estagio $estagio,Request $request)
    {
        $id = $request->input('id');
        $estagio->where('id',$id);
        $estagio->delete();

        return redirect('/estagio')->with('success',"Excluido com sucesso!");
    }
}
