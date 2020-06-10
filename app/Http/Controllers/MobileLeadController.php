<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Lead;

class MobileLeadController extends Controller
{
    public function index(){
        $user = JWTAuth::parseToken()->authenticate();

        $leads = Lead::orderBy('id', 'desc')
        ->where('colaborador_id', $user['id'])
        ->paginate(10);

        return $leads;
    }
}
