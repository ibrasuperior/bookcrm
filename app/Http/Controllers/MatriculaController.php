<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormularioDeMatricula;
use App\matricula;
use App\User;
use App\Equipe;
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
        $nome =  $request->input('nome');
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
        
        if(!empty($nome) ){
            $query->where('nome', 'LIKE', '%'.$nome.'%');
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
        $nome =  $request->input('nome');
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

        if(!empty($nome) ){
            $query->where('nome', 'LIKE', '%'.$nome.'%');
        }

        if(!empty($user) ){
            $query->where('colaborador_id',$user);
        }else{
            $query->where('colaborador_id', $id);
        }
        
        $data = $query->orderBy('id','desc')->get();
        
        return Excel::download(new MatriculasExport($data), 'relatorio.xlsx');
    }
    // EXPORTAR DATA ----------------------------------






     // RELATÓRIOS DE MATRÍCULAS ----------------------------------
     public function reportAdmin(Request $request){
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

        $data = array();
        $comercial1 = array();
        $comercial2 = array();
        $comercial3 = array();
        $comercial4 = array();
        

        //COMERCIAL 1 ------------------------------------------------------
        $comercial1['equipe'] = User::where('equipe_id', 1)
        ->count();
        
        $comercial1['total'] = Matricula::where('equipe_id', 1)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial1['total-geral'] = Matricula::where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 1)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();


        $comercial1['pos'] = Matricula::where('produto', 'Pós-Graduação')
        ->where('equipe_id', 1)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial1['cap'] = Matricula::where('produto', 'Capacitação')
        ->where('equipe_id',1)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial1['complementacao'] = Matricula::where('produto', '!=', 'Pós-Graduação' )
        ->where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 1)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial1['pago'] = Matricula::where('pago', 1)
        ->where('equipe_id', 1)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $equipe1 = Equipe::where('id',1)->first();
        $comercial1['media'] = $comercial1['total'] / $comercial1['equipe'] ;
        $comercial1['meta'] = $equipe1->meta ;
        $comercial1['restante'] = $comercial1['meta'] - $comercial1['total-geral'] ;
        //COMERCIAL 1 ------------------------------------------------------
        

        //COMERCIAL 2 ------------------------------------------------------
        $comercial2['equipe'] = User::where('equipe_id', 2)
        ->count();
        
        $comercial2['total'] = Matricula::where('equipe_id', 2)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial2['total-geral'] = Matricula::where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 2)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();


        $comercial2['pos'] = Matricula::where('produto', 'Pós-Graduação')
        ->where('equipe_id', 2)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial2['cap'] = Matricula::where('produto', 'Capacitação')
        ->where('equipe_id',2)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial2['complementacao'] = Matricula::where('produto', '!=', 'Pós-Graduação' )
        ->where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 2)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial2['pago'] = Matricula::where('pago', 2)
        ->where('equipe_id', 2)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $equipe2 = Equipe::where('id',2)->first();
        $comercial2['media'] =  $comercial2['total'] / $comercial2['equipe'] ;
        $comercial2['meta'] = $equipe2->meta ;
        $comercial2['restante'] = $comercial2['meta'] - $comercial2['total-geral'] ;
        //COMERCIAL 2 ------------------------------------------------------


        //COMERCIAL 3 ------------------------------------------------------
        $comercial3['equipe'] = User::where('equipe_id', 3)
        ->count();
        
        $comercial3['total'] = Matricula::where('equipe_id', 3)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial3['total-geral'] = Matricula::where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 3)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();


        $comercial3['pos'] = Matricula::where('produto', 'Pós-Graduação')
        ->where('equipe_id', 3)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial3['cap'] = Matricula::where('produto', 'Capacitação')
        ->where('equipe_id',3)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial3['complementacao'] = Matricula::where('produto', '!=', 'Pós-Graduação' )
        ->where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 3)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial3['pago'] = Matricula::where('pago', 3)
        ->where('equipe_id', 3)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $equipe3 = Equipe::where('id',3)->first();
        $comercial3['media'] = $comercial3['total'] / $comercial3['equipe'] ;
        $comercial3['meta'] = $equipe3->meta ;
        $comercial3['restante'] = $comercial3['meta'] - $comercial3['total-geral'] ;
        //COMERCIAL 3 ------------------------------------------------------


        //COMERCIAL 4 ------------------------------------------------------
        $comercial4['equipe'] = User::where('equipe_id', 4)
        ->count();
        
        $comercial4['total'] = Matricula::where('equipe_id', 4)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial4['total-geral'] = Matricula::where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 4)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();


        $comercial4['pos'] = Matricula::where('produto', 'Pós-Graduação')
        ->where('equipe_id', 4)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial4['cap'] = Matricula::where('produto', 'Capacitação')
        ->where('equipe_id',4)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial4['complementacao'] = Matricula::where('produto', '!=', 'Pós-Graduação' )
        ->where('produto', '!=', 'Capacitação' )
        ->where('equipe_id', 4)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $comercial4['pago'] = Matricula::where('pago', 4)
        ->where('equipe_id', 4)
        ->whereBetween('created_at',[$dateStart, $dateEnd])
        ->count();

        $equipe4 = Equipe::where('id',4)->first();
        $comercial4['media'] = $comercial4['total'] / $comercial4['equipe'] ;
        $comercial4['meta'] = $equipe4->meta ;
        $comercial4['restante'] = $comercial4['meta'] - $comercial4['total-geral'] ;
        //COMERCIAL 4 ------------------------------------------------------


        //DATA 
        $data['comercial1'] = $comercial1;
        $data['comercial2'] = $comercial2;
        $data['comercial3'] = $comercial3;
        $data['comercial4'] = $comercial4;
        
        return view('relatorios.matriculas')->with('data', $data);
     }
     // RELATÓRIOS DE MATRÍCULAS ----------------------------------
    



     





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
        $matricula->equipe_id =  $request->input('equipe_id');
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