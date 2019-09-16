<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Canal;
use App\Estagio;
use App\User;
use App\matricula;
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

    public function analise(Request $request){
        $inputInicio = Carbon::createFromFormat('d/m/Y', $request->input('inicio') );
        $inputFinal = Carbon::createFromFormat('d/m/Y', $request->input('final') );

        $inicio =  Carbon::parse( $inputInicio )
        ->format('Y-m-d');
        
        $final = Carbon::parse( $inputFinal )
        ->format('Y-m-d');

        //INDICAÇÃO
        $indicacao = array();

        $indicacao['leads'] = Lead::where('canal_id', 7)->whereBetween('created_at',[$inicio,$final])->count();
        $indicacao['matriculas'] =  Matricula::where('canal', 'Indicação')->whereBetween('created_at',[$inicio,$final])->count();
        
        if( !empty( $indicacao['leads']) && !empty( $indicacao['matriculas'] ) ){
            $indicacao['conversao'] =  $indicacao['matriculas'] * 100 / $indicacao['leads'] ;
        }else{
            $indicacao['conversao'] = 0;
        }

        $indicacao['pos'] =  Matricula::where('canal', 'Indicação')->where('produto', 'Pós-Graduação')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $indicacao['segundaLicenciatura'] =  Matricula::where('canal', 'Indicação')->where('produto', 'Segunda Licenciatura')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $indicacao['r2'] =  Matricula::where('canal', 'Indicação')->where('produto', 'R2')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $indicacao['Capacitação'] =  Matricula::where('canal', 'Indicação')->where('produto', 'Capacitação')
        ->whereBetween('created_at',[$inicio,$final])->count();
        
         //Actual
         $actual = array();

         $actual['leads'] = Lead::where('canal_id', 3)->whereBetween('created_at',[$inicio,$final])->count();
         $actual['matriculas'] =  Matricula::where('canal', 'Actual Sales')->whereBetween('created_at',[$inicio,$final])->count();
         
         if( !empty( $actual['leads']) && !empty( $actual['matriculas'] ) ){
             $actual['conversao'] =  $actual['matriculas'] * 100 / $actual['leads'] ;
         }else{
            $actual['conversao'] = 0;
        }
 
         $actual['pos'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'Pós-Graduação')
         ->whereBetween('created_at',[$inicio,$final])->count();
 
         $actual['segundaLicenciatura'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'Segunda Licenciatura')
         ->whereBetween('created_at',[$inicio,$final])->count();
 
         $actual['r2'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'R2')
         ->whereBetween('created_at',[$inicio,$final])->count();
 
         $actual['Capacitação'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'Capacitação')
         ->whereBetween('created_at',[$inicio,$final])->count();

         //Midia
         $midia = array();

         $midia['leads'] = Lead::where('canal_id','!=', 3)->where('canal_id','!=', 7)->where('canal_id','!=', 0)->whereBetween('created_at',[$inicio,$final])->count();
         $midia['matriculas'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Actual Sales')->whereBetween('created_at',[$inicio,$final])->count();
         
         if( !empty( $midia['leads']) && !empty( $midia['matriculas'] ) ){
             $midia['conversao'] =  $midia['matriculas'] * 100 / $midia['leads'] ;
         }else{
            $midia['conversao'] = 0;
        }
 
         $midia['pos'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Actual Sales')->where('produto', 'Pós-Graduação')
         ->whereBetween('created_at',[$inicio,$final])->count();
 
         $midia['segundaLicenciatura'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Actual Sales')->where('produto', 'Segunda Licenciatura')
         ->whereBetween('created_at',[$inicio,$final])->count();
 
         $midia['r2'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Actual Sales')->where('produto', 'R2')
         ->whereBetween('created_at',[$inicio,$final])->count();
 
         $midia['Capacitação'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Actual Sales')->where('produto', 'Capacitação')
         ->whereBetween('created_at',[$inicio,$final])->count();

        $dados =  array(
            'indicacao' => $indicacao,
            'actual' => $actual,
            'midia' => $midia
        );

        return $dados;
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
        $verifica = Lead::where('email', $request->input('leads.0.email') )
        ->count();

        if( $verifica > 0  ){
            $leadFind = Lead::where('email', $request->input('leads.0.email') )
            ->first();

            //verifica se o user esta ativo
            $userToSelect = User::where('id', $leadFind['colaborador_id'] )->first();
            
            if(  $userToSelect['active'] == 1 ){
                $lead->colaborador_id = $leadFind['colaborador_id'];

                $leadFind->delete();
                $lead->save();
                return $lead;
            }
            $leadFind->delete();
            $lead->save();
            return $lead;
        } else{
            $lead->save();
            return $lead;
        }
        
    }

}
