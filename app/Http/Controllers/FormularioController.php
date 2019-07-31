<?php

namespace App\Http\Controllers;
use App\Formulario;
use Illuminate\Http\Request;
use App\Mail\FormularioDeMatricula;
use Illuminate\Support\Facades\Mail;

class FormularioController extends Controller
{
    public function index(){

        return view('formulario.index');
    }

    public function envia(Request $request){
        $dados = $request->except('_token');
        $formulario = Formulario::create($dados);
        $comercial = $request->input('comercial');

        if( $comercial == 1){
            $to = 'cadastro@ibrasuperior.com.br';
        }
        
        if( $comercial == 2){
            $to = 'cadastro02@ibrasuperior.com.br';
        }

        if( $comercial == 3){
            $to = 'cadastro03@ibrasuperior.com.br';
        }

        Mail::to($to)->send(new FormularioDeMatricula($formulario));

        return redirect('/');
    }
}
