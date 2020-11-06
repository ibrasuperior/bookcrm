<?php

namespace App\Http\Controllers;

use App\lead;
use App\Nota;
use App\matricula;
use App\Agenda;
use App\Canal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\LeadsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\MyEvent;

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


    public function index(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        $telefone = $request->input('telefone');
        $canal = $request->input('canal_id');
        $matriculado = $request->input('matriculado');
        $lead = $request->input('lead');

        $query = Lead::query();

        if(!empty($nome)){
            $query->where('nome', 'LIKE', '%'.$nome.'%');
        }
        if(!empty($email)){
            $query->where('email', $email);
        }else {
            $query->where('colaborador_id', \Auth::user()->id);
        }
        if(!empty($telefone)){
            $query->where('telefone', 'LIKE', '%'.$telefone.'%');
        }
        if(!empty($canal)){
            $query->where('canal_id', $canal);
        }
        if(!empty($matriculado)){
            $query->where('matriculado', $matriculado);
        }


        $leads = $query->orderBy('id', 'desc')->paginate(15);

        return view('leads.index')->with('leads', $leads);
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
        if(\Auth::user()->permissoes !== 1){

            $lead->open = true ;
            $lead->update();
        }

        $notas = Nota::orderBy('id', 'desc')->where('lead_id', $id )->paginate(4);

        if( $lead->colaborador_id == \Auth::user()->id or \Auth::user()->permissoes == 1 ){
            return view('leads.show',['lead' => Lead::findOrFail($id)])->with('notas', $notas);
        }else{
            return redirect('/leads')->with('danger','Você não é o dono do Lead !');
        }
    }

    public function search(Request $request){
        $order = $request->input('order');
        $leads = Lead::where('nome', 'LIKE', '%'.$order.'%')->orWhere('email','LIKE',
        '%'.$order.'%')->paginate(20);

        if( count($leads) > 0 ){
            return view('leads.index')->with('leads',$leads);
        }else{
            return redirect('/leads')->with('info','nenhum registro foi localizado');
        }
    }

    public function filter(Request $request){
        $order = $request->input('order');
        $id = \Auth::user()->id;
        $leads = Lead::where('estagio_id', $order )
        ->where('colaborador_id', $id)->orderBy('id', 'desc')->paginate(20);

        return view('leads.index')->with('leads',$leads);

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

     // EXPORTAR DATA ----------------------------------
     public function reportFilter(Request $request)
     {
        $id = \Auth::user()->id;
        $query = Lead::query();
        $canal =  $request->input('canal_id');
        $nome =  $request->input('nome');
        $email =  $request->input('email');
        $telefone =  $request->input('telefone');
        $user =  $request->input('user');
        $situacao =  $request->input('situacao');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');
        $semOperador = $request->input('semOperador');

        if(!empty($nome) ){
            $query->where('nome',$nome);
        
        }
        if(!empty($email) ){
            $query->where('email',$email);
        }

        if(!empty($telefone) ){
            $query->where('telefone',$telefone);
        }

         if(!empty($dateStart) && !empty($dateEnd)){
             $query->whereBetween('created_at',[$dateStart, $dateEnd]);
         }

         if(!empty($dateStart) && empty($dateEnd)){
            $query->whereBetween('created_at',[$dateStart,  Carbon::now()->addDay(1)]);
        }

         if(!empty($situacao) && $situacao == 'Matriculado' ){
            $query->where('matriculado', 1);
        }

        if(!empty($situacao) && $situacao == 'Não Matriculado' ){
            $query->where('matriculado', 0);
        }

        if(!empty($situacao) && $situacao == 'Novos' ){
            $query->where('open', 0);
        }

        if(!empty($situacao) && $situacao == 'Lead Defeituoso' ){
            $query->where('estagio_id', 4);
        }

         if(!empty($canal) ){
             $query->where('canal_id',$canal);
         }

         if(!empty($user) ){
             $query->where('colaborador_id',$user);
         }
         if(!empty($semOperador) && ($semOperador == 'Sim') ){
             $query->where('colaborador_id', '=', 'null');
         }

         $data = $query->orderBy('id','desc')->paginate(20);

         return view('relatorios.leads')->with('leads', $data);
     }
     // EXPORTAR DATA ----------------------------------

    // EXPORTAR DATA ----------------------------------
    public function report(Request $request)
    {

        $query = Lead::query();
        $canal =  $request->input('canal_id');
        $nome =  $request->input('nome');
        $email =  $request->input('email');
        $telefone =  $request->input('telefone');
        $user =  $request->input('user');
        $situacao =  $request->input('situacao');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');

        if(!empty($nome) ){
            $query->where('nome',$nome);
        
        }
        if(!empty($email) ){
            $query->where('email',$email);
        }

        if(!empty($telefone) ){
            $query->where('telefone',$telefone);
        }

         if(!empty($dateStart) && !empty($dateEnd)){
             $query->whereBetween('created_at',[$dateStart, $dateEnd]);
         }

         if(!empty($dateStart) && empty($dateEnd)){
            $query->whereBetween('created_at',[$dateStart,  Carbon::now()->addDay(1)]);
        }

         if(!empty($situacao) && $situacao == 'Matriculado' ){
            $query->where('matriculado', 1);
        }

        if(!empty($situacao) && $situacao == 'Não Matriculado' ){
            $query->where('matriculado', 0);
        }

        if(!empty($situacao) && $situacao == 'Novos' ){
            $query->where('open', 0);
        }

        if(!empty($situacao) && $situacao == 'Lead Defeituoso' ){
            $query->where('estagio_id', 4);
        }

        if(!empty($canal) ){
            $query->where('canal_id',$canal);
        }

        if(!empty($user) ){
            $query->where('colaborador_id',$user);
        }

        $data = $query->orderBy('id','desc')->get();

        return Excel::download(new LeadsExport($data), 'relatorio.xlsx');
    }
     // EXPORTAR DATA ----------------------------------

}