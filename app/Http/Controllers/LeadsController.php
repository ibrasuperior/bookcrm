<?php

namespace App\Http\Controllers;

use App\lead;
use App\matricula;
use App\Agenda;
use App\Canal;
use Illuminate\Http\Request;

class leadsController extends Controller
{
 
    public function dashboard(){
        
        $dateStart = date('y-m-01') ;
        $dateEnd = date('y-m-31');

        $id = \Auth::user()->id;
        $lead = Lead::where('colaborador_id', $id )->whereBetween('created_at',
        [$dateStart, $dateEnd])->get()->count();


        $matricula = Matricula::where('colaborador_id', $id )->whereBetween('created_at',
        [$dateStart, $dateEnd])->sum('quant');

        $agenda = Agenda::where('colaborador_id', $id )->get()->count();

        return view('dashboard')->with('leadCount',$lead)->with('matriculaCount',$matricula)->with('agendaCount',$agenda);
    }


    public function index()
    {
        $id = \Auth::user()->id ;
        $data = Lead::where("colaborador_id",$id)->orderBy('id','desc')->paginate(10);
        return view('leads.index')->with("leads",$data);
    }

    
    public function create()
    {
        $canais = Canal::get();
        return view('leads.novo')->with("canais",$canais);
    }


    public function store(Request $request)
    {
        
        $lead = new Lead;
        $lead->nome = $request->input('nome');
        $lead->email = $request->input('email');
        $lead->telefone = $request->input('telefone');
        $lead->obs = $request->input('obs');
        $lead->canal_id = $request->input('canal_id');
        $lead->colaborador_id = \Auth::user()->id;
        
        $verifica = Lead::where('email', $lead->email )->count();

        if( $verifica > 0 ){
            return redirect('/leads')->with('danger','Esse Lead já foi cadastrado por outro operador!');
        }else{
            $lead->save();
            return redirect('/leads')->with('success',"Cadastrado com sucesso!");
        
        }
    }

    
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->open = true ;
        $lead->update();

        if( $lead->colaborador_id == \Auth::user()->id or \Auth::user()->permissoes == 1 ){
            return view('leads.show',['lead' => Lead::findOrFail($id)]);
        }else{
            return redirect('/leads')->with('danger','Você não é o dono do Lead !');
        }
    }

    public function search(Request $request){
        $order = $request->input('order');
        $leads = Lead::where('nome', 'LIKE', '%'.$order.'%')->orWhere('email','LIKE',
    '%'.$order.'%')->paginate(20);
        
        if( count($leads) > 0 ){
            return view('leads.search')->with('leads',$leads);
        }else{
            return redirect('/leads')->with('success','nenhum registro foi localizado');
        }
    }

    public function filter(Request $request){
        $order = $request->input('order');
        $id = \Auth::user()->id;
        $leads = Lead::where('estagio_id', $order )
        ->where('colaborador_id', $id)->orderBy('id', 'desc')->paginate(20);
        
        return view('leads.search')->with('leads',$leads);
    
    }

    public function edit($id)
    {
        $canais = Canal::get();
        return view('leads.edit', ['lead' => Lead::findOrFail($id)])->with("canais", $canais);
    }


    public function update(Request $request, Lead $lead)
    {
        $lead->nome = $request->input('nome');
        $lead->email = $request->input('email');
        $lead->telefone = $request->input('telefone');
        $lead->canal_id = $request->input('canal_id');
        $lead->obs = $request->input('obs');
        $lead->colaborador_id = \Auth::user()->id;
        $lead->update();

        return redirect('/leads')->with("success","Lead alterado com sucesso!");
        
    }
    
    public function updateEstagio(Request $request,Lead $lead){

        $id = $request->input('id') ;
        $lead->where('id', $id);
        $lead->estagio_id = $request->input('estagio');
        $lead->update();

        return redirect('/leads/show/'.$id )->with("success","Estagio alterado com sucesso!");
    }

    public function destroy(Request $request,Lead $lead)
    {
        $id = $request->input('id');
        $lead->where('id',$id);
        $lead->delete();

        return redirect('/leads')->with('success',"Excluido com sucesso!");
    }
}
