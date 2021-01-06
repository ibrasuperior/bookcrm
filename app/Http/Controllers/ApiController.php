<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Canal;
use App\Events\PushLead;
use App\Estagio;
use App\User;
use App\matricula;
use App\Lead;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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

    public function report(Request $request)
    {
        $data = $request->all();
        return Excel::download(new ReportExport($data), 'relatorio.xlsx');
    }


    public function analise(Request $request){
        $inicio =  $request->input('inicio');
        $final = $request->input('final');

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

        $indicacao['EJA'] =  Matricula::where('canal', 'Indicação')->where('produto', 'EJA')
        ->whereBetween('created_at',[$inicio,$final])->count();
        
        
        //EducaEdu
        $educaedu = array();

        $educaedu['leads'] = Lead::where('canal_id', 25)->whereBetween('created_at',[$inicio,$final])->count();
        $educaedu['matriculas'] =  Matricula::where('canal', 'Educa Edu')->whereBetween('created_at',[$inicio,$final])->count();

        if( !empty( $educaedu['leads']) && !empty( $educaedu['matriculas'] ) ){
            $educaedu['conversao'] =  $educaedu['matriculas'] * 100 / $educaedu['leads'] ;
        }else{
            $educaedu['conversao'] = 0;
        }

        $educaedu['pos'] =  Matricula::where('canal', 'Educa Edu')->where('produto', 'Pós-Graduação')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $educaedu['segundaLicenciatura'] =  Matricula::where('canal', 'Educa Edu')->where('produto', 'Segunda Licenciatura')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $educaedu['r2'] =  Matricula::where('canal', 'Educa Edu')->where('produto', 'R2')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $educaedu['Capacitação'] =  Matricula::where('canal', 'Educa Edu')->where('produto', 'Capacitação')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $educaedu['EJA'] =  Matricula::where('canal', 'Educa Edu')->where('produto', 'EJA')
        ->whereBetween('created_at',[$inicio,$final])->count();
        
        //Actual Sales
        $actualSales = array();

        $actualSales['leads'] = Lead::where('canal_id', 51)->whereBetween('created_at',[$inicio,$final])->count();
        $actualSales['matriculas'] =  Matricula::where('canal', 'Actual Sales')->whereBetween('created_at',[$inicio,$final])->count();

        if( !empty( $actualSales['leads']) && !empty( $actualSales['matriculas'] ) ){
            $actualSales['conversao'] =  $actualSales['matriculas'] * 100 / $actualSales['leads'] ;
        }else{
            $actualSales['conversao'] = 0;
        }

        $actualSales['pos'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'Pós-Graduação')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $actualSales['segundaLicenciatura'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'Segunda Licenciatura')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $actualSales['r2'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'R2')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $actualSales['Capacitação'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'Capacitação')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $actualSales['EJA'] =  Matricula::where('canal', 'Actual Sales')->where('produto', 'EJA')
        ->whereBetween('created_at',[$inicio,$final])->count();

        //Midia
        $midia = array();

        $midia['leads'] = Lead::where('canal_id','!=','7')->where('canal_id','!=','25')->where('canal_id','!=','51')->whereBetween('created_at',[$inicio,$final])->count();
        $midia['matriculas'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Educa Edu')->where('canal','!=','Actual Sales')->whereBetween('created_at',[$inicio,$final])->count();

        if( !empty( $midia['leads']) && !empty( $midia['matriculas'] ) ){
            $midia['conversao'] =  $midia['matriculas'] * 100 / $midia['leads'] ;
        }else{
        $midia['conversao'] = 0;
        }

        $midia['pos'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Educa Edu')->where('canal','!=','Actual Sales')->where('produto', 'Pós-Graduação')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $midia['segundaLicenciatura'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Educa Edu')->where('canal','!=','Actual Sales')->where('produto', 'Segunda Licenciatura')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $midia['r2'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Educa Edu')->where('canal','!=','Actual Sales')->where('produto', 'R2')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $midia['Capacitação'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Educa Edu')->where('canal','!=','Actual Sales')->where('produto', 'Capacitação')
        ->whereBetween('created_at',[$inicio,$final])->count();

        $midia['EJA'] =  Matricula::where('canal','!=','Indicação')->where('canal','!=','Educa Edu')->where('canal','!=','Actual Sales')->where('produto', 'EJA')
        ->whereBetween('created_at',[$inicio,$final])->count();
         
        $dados =  array(
            'indicacao' => $indicacao,
            'midia' => $midia,
            'educaedu' => $educaedu,
            'actualSales' => $actualSales
        );

        return $dados;
    }

    /*
    /-------------------------------------------------------------------------
    /   API PARA EDUCA EDU
    /-------------------------------------------------------------------------
    /
    /
    */
    public function leadsEducaEdu(Request $request){
        $lead = new Lead;

        $user = User::where('permissoes' ,'>', 1)
        ->where('leads_active', true)
        ->orderBy('educa_leads','asc')->first();

        $lead->nome = $request->input('name');
        $lead->email = $request->input('email');
        $lead->telefone = $request->input('phone');
        $lead->obs = $request->input('obs');
        $lead->canal_id = 25;
        $lead->colaborador_id = $user['id'];

        //Verifica se já é lead
        $verifica = Lead::where('email', $request->input('email') )
        ->count();

        if( $verifica > 0  ){
            $leadFind = Lead::where('email', $request->input('email') )
            ->first();

            //verifica se o user esta ativo
            $userToSelect = User::where('id', $leadFind['colaborador_id'] )->first();

            if(  $userToSelect['active'] == 1 ){
                $lead->colaborador_id = $leadFind['colaborador_id'];

                 //incrementa leads daily
                User::where('id', $leadFind['colaborador_id'])->update(['educa_leads' => 1 ]);

                //collection leads daily
                $plucked = User::where('permissoes' ,'>', 1)
                ->where('leads_active', true)->pluck('educa_leads');

                if( $plucked->sum() == count($plucked) ){
                    DB::table('users')->update(['educa_leads' => 0 ]);
                }

                $leadFind->delete();
                $lead->save();

                event(new PushLead(  $leadFind['colaborador_id'] ));

                return $lead;
            }


            //incrementa leads daily
            User::where('id', $user['id'])->update(['educa_leads' => 1 ]);

            //collection leads daily
            $plucked = User::where('permissoes' ,'>', 1)
            ->where('leads_active', true)->pluck('educa_leads');

            if( $plucked->sum() == count($plucked) ){
                DB::table('users')->update(['educa_leads' => 0 ]);
            }

            $leadFind->delete();
            $lead->save();
            event(new PushLead(  $user['id'] ));

            return $lead;
        } else{
            //incrementa leads daily
            User::where('id', $user['id'])->update(['educa_leads' => 1 ]);

            //collection leads daily
            $plucked = User::where('permissoes' ,'>', 1)
            ->where('leads_active', true)->pluck('educa_leads');

            if( $plucked->sum() == count($plucked) ){
                DB::table('users')->update(['educa_leads' => 0 ]);
            }

            $lead->save();
            event(new PushLead(  $user['id'] ));

            return $lead;
        }
    }



    /*
    /-------------------------------------------------------------------------
    /   API PARA RD STATION
    /-------------------------------------------------------------------------
    /
    /
    /
    /
    */

    public function leadsStation(Request $request){
        $lead = new Lead;

        $user = User::where('permissoes' ,'>', 1)
        ->where('leads_active', true)
        ->orderBy('leads_daily','asc')->first();

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
            $channel = 'Outros' ;
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

        $lead->canal_id = $canal['id'];

        if($conversao == "Actual Sales"){
            $lead->canal_id = 51;
        }
        
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

            //incrementa leads daily
            User::where('id', $leadFind['colaborador_id'])->update(['leads_daily' => 1 ]);

            //collection leads daily
            $plucked = User::where('permissoes' ,'>', 1)
            ->where('leads_active', true)->pluck('leads_daily');

            if( $plucked->sum() == count($plucked) ){
                DB::table('users')->update(['leads_daily' => 0 ]);
            }

            //verifica se é matriculado
            if( $leadFind['matriculado'] == 1){
                $lead->matriculado = 1 ;
            }

            $leadFind->delete();
            $lead->save();

            event(new PushLead(  $leadFind['colaborador_id'] ));

            return $lead;
            }else{
                 //verifica se é matriculado
                if( $leadFind['matriculado'] == 1){
                    $lead->matriculado = 1 ;
                }

                $leadFind->delete();

                $lead->colaborador_id = $user['id'];

                //incrementa leads daily
                User::where('id', $user['id'])->update(['leads_daily' => 1 ]);

                //collection leads daily
                $plucked = User::where('permissoes' ,'>', 1)
                ->where('leads_active', true)->pluck('leads_daily');

                if( $plucked->sum() == count($plucked) ){
                    DB::table('users')->update(['leads_daily' => 0 ]);
                }

                event(new PushLead(  $user['id'] ));

                $lead->save();
                return $lead;
            }

        } else{
            $lead->colaborador_id = $user['id'];

            //incrementa leads daily
            User::where('id', $user['id'])->update(['leads_daily' => 1 ]);

            //collection leads daily
            $plucked = User::where('permissoes' ,'>', 1)
            ->where('leads_active', true)->pluck('leads_daily');

            if( $plucked->sum() == count($plucked) ){
                DB::table('users')->update(['leads_daily' => 0 ]);
            }

            $lead->save();

            event(new PushLead( $user['id'] ));

            return $lead;
        }

    }
    
    public function leadsAssertiva(Request $request){
        $lead = new Lead;

        $user = 382 ;

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
            $channel = 'Outros' ;
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

            //incrementa leads daily
            User::where('id', $leadFind['colaborador_id'])->update(['leads_daily' => 1 ]);

            //collection leads daily
            $plucked = User::where('permissoes' ,'>', 1)
            ->where('leads_active', true)->pluck('leads_daily');

            if( $plucked->sum() == count($plucked) ){
                DB::table('users')->update(['leads_daily' => 0 ]);
            }

            //verifica se é matriculado
            if( $leadFind['matriculado'] == 1){
                $lead->matriculado = 1 ;
            }

            $leadFind->delete();
            $lead->save();

            event(new PushLead(  $leadFind['colaborador_id'] ));

            return $lead;
            }else{
                 //verifica se é matriculado
                if( $leadFind['matriculado'] == 1){
                    $lead->matriculado = 1 ;
                }

                $leadFind->delete();

                $lead->colaborador_id = $user;

                //incrementa leads daily
                User::where('id', $user)->update(['leads_daily' => 1 ]);

                //collection leads daily
                $plucked = User::where('permissoes' ,'>', 1)
                ->where('leads_active', true)->pluck('leads_daily');

                if( $plucked->sum() == count($plucked) ){
                    DB::table('users')->update(['leads_daily' => 0 ]);
                }

                event(new PushLead(  $user ));

                $lead->save();
                return $lead;
            }

        } else{
            $lead->colaborador_id = $user;

            //incrementa leads daily
            User::where('id', $user)->update(['leads_daily' => 1 ]);

            //collection leads daily
            $plucked = User::where('permissoes' ,'>', 1)
            ->where('leads_active', true)->pluck('leads_daily');

            if( $plucked->sum() == count($plucked) ){
                DB::table('users')->update(['leads_daily' => 0 ]);
            }

            $lead->save();

            event(new PushLead( $user ));

            return $lead;
        }

    }
}