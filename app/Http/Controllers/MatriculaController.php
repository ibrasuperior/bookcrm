<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormularioDeMatricula;
use App\matricula;
use App\Formulario;
use Carbon\Carbon;
use App\Exports\MatriculasExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index(Request $request)
    {
        // TRANSFORMAR DATA ----------------------------------
        if( !empty($request->input('dateStart')) ){
            $inputInicio = Carbon::createFromFormat('d/m/Y', $request->input('dateStart') )->subDays(1);     
            $dateStart =  Carbon::parse( $inputInicio )
            ->format('Y-m-d');
   
        }

        if( !empty($request->input('dateEnd')) ){
           $inputFinal = Carbon::createFromFormat('d/m/Y', $request->input('dateEnd') )->addDay(1);
           $dateEnd = Carbon::parse( $inputFinal )
           ->format('Y-m-d');
       }
        // TRANSFORMAR DATA ----------------------------------

        $id = \Auth::user()->id;
        $query = Matricula::query();
        $produto =  $request->input('produto');
        $user =  $request->input('user');
        
        if(!empty($dateStart) && !empty($dateEnd)){
            $query->whereBetween('created_at',[$dateStart, $dateEnd]);
        }
        if(!empty($dateStart) && empty($dateEnd)){
           $query->whereBetween('created_at',[$dateStart,  Carbon::now()->addDay(1)]);
       }

        if(!empty($produto) ){
            $query->where('produto',$produto);
        }

        if(!empty($user) ){
            $query->where('colaborador_id',$user);
        }else{
            $query->where('colaborador_id', $id);
        }
        
        $data = $query->orderBy('id','desc')->paginate(20);

        return view('matriculas.index')->with('matriculas',$data);
    }

     // EXPORTAR DATA ----------------------------------
    public function report(Request $request)
    {
         // TRANSFORMAR DATA ----------------------------------
         if( !empty($request->input('dateStart')) ){
            $inputInicio = Carbon::createFromFormat('d/m/Y', $request->input('dateStart') )->subDays(1);     
            $dateStart =  Carbon::parse( $inputInicio )
            ->format('Y-m-d');
   
        }

        if( !empty($request->input('dateEnd')) ){
           $inputFinal = Carbon::createFromFormat('d/m/Y', $request->input('dateEnd') )->addDay(1);
           $dateEnd = Carbon::parse( $inputFinal )
           ->format('Y-m-d');
       }
        // TRANSFORMAR DATA ----------------------------------

        $id = \Auth::user()->id;
        $query = Matricula::query();
        $produto =  $request->input('produto');
        $user =  $request->input('user');
        
        if(!empty($dateStart) && !empty($dateEnd)){
            $query->whereBetween('created_at',[$dateStart, $dateEnd]);
        }
        if(!empty($dateStart) && empty($dateEnd)){
           $query->whereBetween('created_at',[$dateStart,  Carbon::now()->addDay(1)]);
       }

        if(!empty($produto) ){
            $query->where('produto',$produto);
        }

        if(!empty($user) ){
            $query->where('colaborador_id',$user);
        }else{
            $query->where('colaborador_id', $id);
        }
        
        $data = $query->orderBy('id','desc')->paginate(20);
        
        return Excel::download(new MatriculasExport($data), 'relatorio.xlsx');
    }
    // EXPORTAR DATA ----------------------------------

    
    public function store(Request $request)
    {
        $matricula = new Matricula;

        $matricula->nome = $request->input('nome') ;
        $matricula->canal =  $request->input('canal');
        $matricula->valor =$request->input('valor') ;
        $matricula->vencimento =$request->input('vencimento') ;
        $matricula->produto =  $request->input('produto');
        $matricula->pagamento =  $request->input('pagamento');
        $matricula->estado =  $request->input('estado');
        $matricula->colaborador_id =  $request->input('colaborador_id');
        $matricula->save();

        $id_lead = $request->input('id_lead') ;

        $lead = \App\lead::find($id_lead);

        $lead->matriculado = true ;

        $lead->save();

        return view('matriculas.indicacao')->with('info', 'Matriculado com sucesso, solicite uma indicação!');
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $matricula = Matricula::find('id', $id);
        return view('matriculas.show')->with('matriculas',$matricula);
    }

    public function update(Request $request, d $d)
    {
        //
    }

    public function pagamentoIn($id){
        Matricula::where('id', $id)->update(['pago' => 1 ]);
        return redirect('/matriculas')->with('success',"Alterado com sucesso");
    }

    public function pagamentoOut($id){
        Matricula::where('id', $id)->update(['pago' => 0 ]);
        return redirect('/matriculas')->with('success',"Alterado com sucesso");
    }

    public function search(Request $request){
        $order = $request->input('order');
        $matriculas = Matricula::orderBy('id','DESC')->where('nome', 'LIKE', '%'.$order.'%')->paginate(20);

        if( count($matriculas) > 0 ){
            return view('matriculas.index')->with('matriculas',$matriculas);
        }else{
            return redirect('/matriculas')->with('info','nenhum registro foi localizado');
        }
    }

    public function destroy(Request $request,Matricula $matricula)
    {
        $id = $request->input('id');
        $matricula->where('id',$id);
        $matricula->delete();

        return redirect('/matriculas')->with('success',"Excluido com sucesso!");
    }

}