<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Aviso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvisoController extends Controller
{
    public function index(Request $request)
    { 
        $titulo = $request->input('titulo');
        $autor = $request->input('autor');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');
        $query = Aviso::query();

        if(!empty($titulo)){
            $query->where('titulo', $titulo);
        }
        if(!empty($autor)){
            $query->where('autor', $autor);
        }
        if(!empty($dateStart) && !empty($dateEnd)){
            $query->where('dataInicio', '>' ,$dateStart)->where('dataFinal', '<', $dateEnd);
        }
        if(!empty($dateStart)){
            $query->where('dataInicio', '>=' ,$dateStart)->where('dataFinal', '<=', Carbon::now()->addDay(1));
        }

        if( !isset($dateStart) ){
            $query->where('dataFinal', '>',  Carbon::now()->addDay(1))->orWhere('dataFinal', null);
        }    

        $avisos = $query->orderBy('id', 'desc')->paginate(15);

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
        $avisos->tipo = $request->input('typeNotice');
        $avisos->dataInicio = $request->input('dateStart');
        $avisos->dataFinal = $request->input('dateEnd');
        $avisos->autor = $request->input('autor');
        if(!empty($request->file('anexo'))){
            $avisos->anexo = $request->file('anexo')->store('/');
        }
        $avisos->save();

        return redirect('/avisos')->with('success',"Cadastrado com sucesso!");
    }
  
    public function edit($id)
    {
        $aviso = Aviso::findOrFail($id);
        return view('avisos.edit')->with('aviso', $aviso);
    }

    public function update(Request $request, Aviso $aviso)
    {
        $avisos = Aviso::findOrFail($aviso->id);

        $avisos->titulo = $request->input('titulo');
        $avisos->descricao = $request->input('editor1');
        $avisos->tipo = $request->input('typeNotice');
        $avisos->dataInicio = $request->input('dateStart');
        $avisos->dataFinal = $request->input('dateEnd');
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