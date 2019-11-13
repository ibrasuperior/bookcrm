<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $id =\Auth::user()->id ;
        $agendas = Agenda::orderBy('id', 'desc')->where("colaborador_id",$id)->get();
        return view('agenda.index')->with('agendas',$agendas);
    }


    public function create()
    {
        return view('agenda.novo');
    }


    public function store(Request $request)
    {
        $agenda = new Agenda;
        $agenda->nome = $request->input('nome');
        $agenda->data = $request->input('data');
        $agenda->hora = $request->input('hora');
        $agenda->descricao = $request->input('descricao');
        $agenda->colaborador_id = \Auth::user()->id;
        $agenda->save();

        return redirect('/agenda')->with('success',"Cadastrado com sucesso!");
    }

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        if( $agenda->colaborador_id == \Auth::user()->id ){
            return view('agenda.show',['agenda' => Agenda::findOrFail($id)]);
        }else{
            return redirect('/agenda')->with('success','você não tem acesso a esse conteúdo');
         }
    }


    public function edit(d $d)
    {
        //
    }


    public function update(Request $request, Agenda $agenda)
    {
        $agenda->nome = $request->input('nome');
        $agenda->hora = $request->input('hora');
        $agenda->data = $request->input('data');
        $agenda->descricao = $request->input('descricao');
        $agenda->colaborador_id = \Auth::user()->id;
        $agenda->update();

        return redirect('/agenda')->with("success","Compromisso alterado com sucesso!");
    }


    public function destroy(Request $request,Agenda $agenda)
    {
        $id = $request->input('id');
        $agenda->where('id',$id);
        $agenda->delete();

        return redirect('/agenda')->with('success',"Excluido com sucesso!");
    }
}
