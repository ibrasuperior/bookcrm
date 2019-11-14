<?php

namespace App\Http\Controllers;
use App\Nota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotaController extends Controller
{
    public function store(Request $request){
        $data = $request->except('_token');

        $nota = Nota::create($data);

        return redirect('/leads/show/' . $data['lead_id'] ) ;
    }
}
