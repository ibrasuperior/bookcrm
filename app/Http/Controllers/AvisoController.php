<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Aviso;
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
        if(!empty($request->file('anexo'))){
            $avisos->anexo = $request->file('anexo')->store('/');
        }
        $avisos->save();

        return redirect('/avisos')->with('success',"Cadastrado com sucesso!");
    }
  
    public function edit($id)
    {
        return view('avisos.edit', ['aviso' => Aviso::findOrFail($id)]);
    }

    public function update(Request $request, Aviso $aviso)
    {
        $avisos = Aviso::findOrFail($aviso->id);

        $avisos->titulo = $request->input('titulo');
        $avisos->descricao = $request->input('editor1');
        if(!empty($request->file('anexo'))){
            Storage::delete( $aviso['anexo']);
            $avisos->anexo = $request->file('anexo')->store('/');
        } else {
            $avisos->anexo = $aviso->anexo;
        }
        $avisos->update();
   
        return redirect('/avisos')->with("success","Alterado com sucesso!");

    }

    public function destroy(Aviso $aviso,Request $request)
    {   
        Aviso::findOrFail($aviso->id);
        Storage::delete( $aviso['anexo']);
        $aviso->delete();

    	return redirect('/avisos')->with('success', 'Deletado com sucesso !');        
    }
}
