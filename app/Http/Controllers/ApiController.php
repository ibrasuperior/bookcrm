<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Canal;
use App\Estagio;
use App\User;
use App\Matricula;
use App\Lead;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ApiController extends Controller
{
    public function chartSales(){
        
        $matriculas['first'] = Matricula::whereBetween("created_at",
        [ Carbon::now()->subMonth(2) , Carbon::now()->subMonth(1) ])
        ->sum('quant');

        return $matriculas;
    }

    public function midia(){
        $midias = Canal::get();
        return $midias;
    }

    public function estagios(){
        $estagios = Estagio::get();
        return $estagios;
    }

    public function userAttempt(){
        $user = Auth::user();
        return $user;
    }

    public function users(){
        $users = User::get();
        return $users;
    }

    public function export(Request $request) 
    {
        $data = $request->all();
        return Excel::download(new ReportExport($data), 'relatorio.xlsx');
    }

    
    //INTEGRAÇÃO COM RD STATION

    public function leadsStation(Request $request){
        $lead = new Lead;

        $user = User::where('permissoes' ,'>', 1)
        ->where('active', true)
        ->orderBy('leads_daily','asc')->first();
        
        User::where('id', $user['id'] )->increment( 'leads_daily', 1 );
        
        $channel = $request->input('leads.0.last_conversion.conversion_origin.channel');
        
        //traduzir canais
        if( $channel == 'Direct'){
            $channel = 'Tráfego Direto' ;
        }
        
        if( $channel == 'Referral'){
            $channel = 'Referência' ;
        }

        if( $channel == 'Social'){
            $channel = 'Mídia Social' ;
        }

        if( $channel == 'Organic Search'){
            $channel = 'Busca Orgânica' ;
        }

        if( $channel == 'Paid Search'){
            $channel = 'Busca Paga' ;
        }
        if( $channel == '(Other)'){
            $channel = 'Outros' ;
        }
        if( $channel == 'Other advertisements'){
            $channel = 'Outras Publicidades' ;
        }
        if( $channel == 'Unknown'){
            $channel = 'Actual Sales' ;
        }
        
        //CANAL PARA INSERÇÃO
        $canal = Canal::where('nome', $channel )->first();

        $conversao = $request->input('leads.0.last_conversion.content.identificador');
        $link = $request->input('leads.0.public_url');

        //regras    
        $lead->nome = $request->input('leads.0.name');  
        $lead->email = $request->input('leads.0.email');
        $lead->telefone = $request->input('leads.0.personal_phone');
        $lead->origem = $conversao . '<a target="_blank" class="ls-btn-xs ls-btn-default" href=" ' . $link . ' ">
            Link do RD Station
        </a>' ;
        $lead->colaborador_id = $user['id'];
        $lead->canal_id = $canal['id'];  
        
        //Verifica se já é lead  
        $verifica = Lead::where('email', $request->input('leads.0.email') )->count();

        if( $verifica > 0  ){
            $leadFind = Lead::where('email', $request->input('leads.0.email') )
            ->first();

            $lead->colaborador_id = $leadFind['colaborador_id'];

            $leadFind->delete();
            $lead->save();
            return $lead;
        }else{
            $lead->save();
            return $lead;
        }
        
    }

}
