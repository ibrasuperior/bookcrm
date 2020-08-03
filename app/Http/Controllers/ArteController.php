<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Arte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArteController extends Controller
{
    public function index(Request $request){
        $nome = $request->input('nome');
        $personalizavel = $request->input('personalizavel');

        $query = Arte::query();

        if(!empty($nome)){
            $query->where('nome', 'LIKE', '%'.$nome.'%');
        }
        if(!empty($personalizavel)){
            if($personalizavel == "true"){
                $query->where('personalizavel', 1);
            } else {
                $query->where('personalizavel', 0);
            }
        }


        $artes = $query->orderBy('id', 'desc')->paginate(15);

        return view('artes.index')->with('artes', $artes);
    }

    public function pecas(){
        return view('artes.pecas');
    }

    public function peca(){
        return view('artes.peca');

    }

    public function edit($id){
        return view('artes.edit',['artes' => Arte::findOrFail($id)]);
    }

    public function download(Request $request){
        $file = $request->input('file');
        return response()->download('storage/artes/' . $file);

    }

    public function store(Request $request){
    	$arte = new Arte;
    	$arte->nome = $request->input('nome');
    	$arte->img = $request->file('img')->store('/');
        $arte->personalizavel = $request->input('personalizavel');

    	$arte->save();

    	return redirect('/artes')->with('success', 'Arte cadastrada com sucesso !');
    }

    public function update(Request $request, $id){
        $arte = Arte::findOrFail($id);

    	$arte->nome = $request->input('nome');
        $arte->personalizavel = $request->input('personalizavel');

    	$arte->update();

        return redirect('/artes')->with('success', 'Arte Editada com sucesso !');

    }

    public function destroy($id){
    	$arte = Arte::findOrFail($id);

		Storage::delete( $arte['img']);
		$arte->delete();

    	return redirect('/artes')->with('success', 'Deletado com sucesso !');

    }

}