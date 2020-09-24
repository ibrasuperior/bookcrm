<?php

namespace App\Http\Controllers;
use App\Aviso;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvisoController extends Controller
{
    public function index()
    {
        $avisos = Aviso::get();
        return view('avisos.index')->with('avisos',$avisos);
    }

   
    public function create()
    {
        return view('avisos.novo');
    }

    
    public function store(Request $request)
    {
        $avisos = new Aviso;
        $avisos->titulo = $request->input('titulo');
        $avisos->descricao = $request->input('editor1');
        $avisos->autor = $request->input('autor');
        $avisos->save();
        
        return redirect('/avisos')->with('success',"Cadastrado com sucesso!");
    }
  
    public function edit($id)
    {
        return view('avisos.edit', ['aviso' => Aviso::findOrFail($id)]);
    }

    public function update(Request $request, Aviso $aviso)
    {
        $aviso->titulo = $request->input('titulo');
        $aviso->descricao = $request->input('editor1');
        
        $aviso->update();
        return redirect('/avisos')->with("success","Alterado com sucesso!");

    }

    public function destroy(Aviso $aviso,Request $request)
    {   
        $id = $aviso->id;
        $id = Aviso::findOrFail($id);
        $aviso->delete();

    	return redirect('/avisos')->with('success', 'Deletado com sucesso !');
        
    }
}
