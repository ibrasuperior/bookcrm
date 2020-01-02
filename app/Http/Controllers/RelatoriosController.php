<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class RelatoriosController extends Controller

{
    public function index(){
        return view('relatorios.index');
    }

    public function matriculas(){
        return view('relatorios.matriculas.index');
    }
}
