<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    public function index(Request $request){
        $permissoes = $request->input('permissoes');
        $equipe = $request->input('equipe');
        $leads = $request->input('leads');
        $name = $request->input('name');
        
        $query = User::query();
        
        if(!empty($permissoes)){
            $query->where('permissoes', $permissoes );
        }

        if(!empty($leads) &&  $request->input('leads') == 1 ){
            $query->where('active', 1 );
            $query->where('leads_active', 1 );
        }

        if(!empty($leads) &&  $request->input('leads') == 2 ){
            $query->where('active', 1 );
            $query->where('leads_active', 0 );
        }

        if(!empty($leads) &&  $request->input('leads') == 3 ){
            $query->where('active', 0 );
            $query->where('leads_active', 0 );
        }
        
        if(!empty($equipe)){
            $query->where('equipe_id', $equipe );
        }

        if(!empty($name) ){
            $query->where('name', 'LIKE', '%'.$name.'%');
        }
        
        $users = $query->orderBy('id','asc')->paginate(20);
         
        return view('users.index')->with('users', $users); 
    }


    public function create()
    {
        return view('users.novo');
    }

    
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')) ;
        $user->permissoes = $request->input('permissoes');
        $user->save();
        
        return redirect('/users')->with('success',"Cadastrado com sucesso!");
    }

  
    public function show(User $user)
    {
        //
    }

  
    public function edit($id,Request $request)
    {
   
        return view('users.edit',['user' => User::findOrFail($id)]);
    }

  
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        //$user->leads_active = $request->input('leads_active');
        //$user->active = $request->input('active');
        $user->permissoes = $request->input('permissoes');
        $user->equipe_id = $request->input('equipe');

        //USUÁRIO ATIVO NÃO RECEBE LEADS
        if( $request->input('active') == 1 ){
            $user->leads_active = 0 ;
            $user->active = 1 ;
        }

         //USUÁRIO ATIVO RECEBE LEADS
         if( $request->input('active') == 2 ){
            $user->leads_active = 1 ;
            $user->active = 1 ;
        }

         //USUÁRIO INATIVO
         if( $request->input('active') == 3 ){
            $user->leads_active = 0 ;
            $user->active = 0 ;
        }


        if(!empty($request->input('password'))){
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->update();
        return redirect('/users')->with("success","Alterado com sucesso!");
    }

    public function updateProfile(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if(!empty($request->input('password'))){
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->update();
        return redirect('/')->with("success","Alterado com sucesso!");
    }
    
    public function destroy(Request $request,User $user)
    {
        $id = $request->input('id');
        $user->where('id',$id);
        $user->delete();

        return redirect('/users')->with('success',"Excluido com sucesso!");
    }

    public function profile($id,Request $request)
    {
        if( $id == \Auth::user()->id ){
           return view('profile.index',['user' => User::findOrFail($id)]);
        }else{
            return redirect('/')->with('Você não tem permissões para alterar !');
        }
    }


}