<?php

namespace App\Http\Controllers;

use App\Canal;
use App\Lead;
use Illuminate\Http\Request;

class CanalController extends Controller
{
    
    public function index()
    {
        $canais = Canal::get();
        return view('canal.index')->with('canais',$canais);
    }

   
    public function create()
    {
        return view('canal.novo');
    }

    
    public function store(Request $request)
    {
        $canal = new Canal;
        $canal->nome = $request->input('nome');
        $canal->save();
        
        return redirect('/canal')->with('success',"Cadastrado com sucesso!");
    }

   
    public function show(d $d)
    {
        //
    }


  
    public function edit($id)
    {
        return view('canal.edit', ['canal' => Canal::findOrFail($id)]);
    }
    

    public function update(Request $request, Canal $canal)
    {
        $canal->nome = $request->input('nome');
        $canal->update();
        return redirect('/canal')->with("success","Alterado com sucesso!");

    }

    public function destroy(Canal $canal,Request $request)
    {
        $id = $request->input('id');
        $lead = Lead::where('canal_id', $request->input('id') )->get();
        $canal->where('id',$id);

        if( $lead->count() > 0 ){
            return redirect('/canal')->with('danger',"Existe Lead com essa Mídia!");
        }else{
            $canal->delete();
            return redirect('/canal')->with('success',"Excluído com sucesso!");
        }
    }
}
