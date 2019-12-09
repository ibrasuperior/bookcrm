<?php

namespace App\Exports;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Lead;
use Carbon\Carbon;

class ReportExport implements FromView
{
    use Exportable;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $operador = $this->data['colaborador_id'];
        //formatando datas
        $dataInicio = str_replace('/', '-', $this->data['dataInicio'] ) ;
        $dataFinal = str_replace('/', '-', $this->data['dataFinal'] ) ;
        
        $from = date('Y-m-d', strtotime( $dataInicio ));
        $to = date('Y-m-d', strtotime( $dataFinal ));

        $leads = Lead::where(function($query) use (
            $canal, $operador, $to, $from,  $dataInicio, $dataFinal 
            ) {
            if( !empty($canal) ){
                $query->where('aquisicao_id', $canal);
            }

            if( !empty($estagio) ){
                $query->where('estagio', $estagio);
            }

            if( !empty($operador) ){
                $query->where('colaborador_id', $operador);
            }

            if( !empty($dataInicio) && !empty($dataFinal) ){
                if( $dataInicio === $dataFinal ){
                    $query->whereDate('created_at', new Carbon($from));
                }else{
                    $query->whereBetween('created_at', [ new Carbon($from), new Carbon($to)]);
                }   
            }
            
        } )
        ->get();
        
        return view('report.index')->with('leads', $leads)->with('data', $from);
    }
}
