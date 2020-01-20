<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    public function index()
    {
        $user = User::get();
        return view('users.index')->with('users',$user);
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
        $user->active = $request->input('active');
        $user->permissoes = $request->input('permissoes');
        $user->equipe_id = $request->input('equipe');

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