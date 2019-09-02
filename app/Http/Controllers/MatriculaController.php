<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormularioDeMatricula;
use App\matricula;
use App\Formulario;

use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $id = \Auth::user()->id;
        $dados = Matricula::where('colaborador_id',$id)->orderBy('id','desc')->paginate(5);
        return view('matriculas.index')->with('matriculas',$dados);
    }

    public function store(Request $request)
    {
        $matricula = new Matricula;
        
        $matricula->nome = $request->input('nome') ; 
        $matricula->quant = $request->input('quant') ;
        $matricula->canal =  $request->input('canal'); 
        $matricula->valor =$request->input('valor') ;
        $matricula->vencimento =$request->input('vencimento') ;
        $matricula->produto =  $request->input('produto');
        $matricula->pagamento =  $request->input('pagamento');
        $matricula->estado =  $request->input('estado');
        $matricula->colaborador_id =  $request->input('colaborador_id');
        $matricula->save();

        $id_lead = $request->input('id_lead') ;
        
        $lead = \App\lead::find($id_lead);

        $lead->matriculado = true ;

        $lead->save();

        return redirect('formulario/' . $id_lead );
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $matricula = Matricula::find('id', $id);
        return view('matriculas.show')->with('matriculas',$matricula);
    }

    public function update(Request $request, d $d)
    {
        //
    }

    public function pagamentoIn($id){
        Matricula::where('id', $id)->update(['pago' => 1 ]);
        return redirect('/matriculas')->with('success',"Alterado com sucesso");        
    }

    public function pagamentoOut($id){
        Matricula::where('id', $id)->update(['pago' => 0 ]);
        return redirect('/matriculas')->with('success',"Alterado com sucesso");        
    }

    public function search(Request $request){
        $order = $request->input('order');
        $matriculas = Matricula::orderBy('id','DESC')->where('nome', 'LIKE', '%'.$order.'%')->get();
        
        if( count($matriculas) > 0 ){
            return view('matriculas.search')->with('matriculas',$matriculas);
        }else{
            return redirect('/matriculas')->with('success','nenhum registro foi localizado');
        }
    }

    public function destroy(Request $request,Matricula $matricula)
    {
        $id = $request->input('id');
        $matricula->where('id',$id);
        $matricula->delete();
        
        return redirect('/matriculas')->with('success',"Excluido com sucesso!");
    }

}
