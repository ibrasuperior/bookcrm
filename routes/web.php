<?php


Route::middleware(['auth'])->group(function(){
    Route::get('/',"LeadsController@dashboard");

    //relatórios matricula
    Route::get('/matriculas/report', "MatriculaController@report");

    //relatórios leads
    Route::get('/relatorios/leads', function(){
        if(\Auth::user()->permissoes == 1){
            $leads = \App\Lead::orderBy('id','desc')->paginate(15);
            return view('relatorios.leads')->with('leads' ,$leads);
        }else{
            return redirect('/leads')->with('danger' ,'você não tem acesso à relatórios');
        }
    });
    //Analise de Canais
    Route::get('/relatorios/analise', function(){
        return view('relatorios.analise');
    });

    Route::get('/relatorios/leads/filter', "LeadsController@reportFilter");
    Route::get('/relatorios/leads/report', "LeadsController@report");

    //NOTAS
    Route::post('/notas/add',"NotaController@store");

    //Lead
    Route::put('/leads/updateEstagio/{lead}',"LeadsController@updateEstagio");
    Route::get('/leads/filter',"LeadsController@filter");
    Route::get('/leads/search',"LeadsController@search");
    Route::get('/leads',"LeadsController@index");
    Route::get('/leads/novo',"LeadsController@create");
    Route::post('/leads/add',"LeadsController@store");
    Route::get('/leads/{id}',"LeadsController@edit");
    Route::get('/leads/show/{id}', "LeadsController@show");
    Route::put('/leads/update/{lead}',"LeadsController@update");
    Route::get('/leads/delete/{lead}',"LeadsController@destroy");

    //matrícula
    Route::get('/matriculas/search',"MatriculaController@search");
    Route::get('/matriculas',"MatriculaController@index");
    Route::get('/matriculas/pagamento-in/{id}',"MatriculaController@pagamentoIn");
    Route::get('/matriculas/pagamento-out/{id}',"MatriculaController@pagamentoOut");
    Route::post('/matriculas/add',"MatriculaController@store");
    Route::get('/matriculas/{id}',"MatriculaController@edit");
    Route::get('/matriculas/show/{id}', "MatriculaController@show");
    Route::get('/matriculas/report', "MatriculaController@report");
    Route::put('/matriculas/update/{matricula}',"MatriculaController@update");
    Route::get('/matriculas/delete/{matricula}',"MatriculaController@destroy");

    //Agenda
    Route::get('/agenda',"AgendaController@index");
    Route::get('/agenda/novo', "AgendaController@create");
    Route::post('/agenda/add',"AgendaController@store");
    Route::get('/agenda/show/{id}', "AgendaController@show");
    Route::put('/agenda/update/{agenda}',"AgendaController@update");
    Route::get('/agenda/delete/{agenda}',"AgendaController@destroy");

    /*/Profile/*/
    Route::get('/profile/{id}',"UsersController@profile");
    Route::put('/profile/update/{user}',"UsersController@updateProfile");

    /*/Documentos/*/
    Route::get('/documentos', function(){
        return view('documentos.pastas');
    });

    Route::get('/documento/pasta', function(){
        return view('documentos.index');
    });

    //Formulario de matrícula
    Route::get('/formulario/{id}', 'FormularioController@index');
    Route::post('/formulario/envia', 'FormularioController@envia');

    /*/API/*/
    Route::get('/api/midias',"ApiController@midia");
    Route::get('/api/users',"ApiController@users");
    Route::get('/api/user-attempt',"ApiController@userAttempt");
    Route::get('/api/estagios',"ApiController@estagios");

    /*/ARTES/*/
    Route::get('/artes',"ArteController@index");
    Route::get('/artes/download',"ArteController@download");
    Route::get('/artes/pecas',"ArteController@pecas");
    Route::post('/artes/peca',"ArteController@peca");


});

Auth::routes();

Auth::routes(['register' => false]);

Route::middleware(['security'])->group(function(){

    /*/ARTES/*/
    Route::get('/artes/destroy/{id}','ArteController@destroy');
    Route::get('/artes/edit/{id}', 'ArteController@edit');
    Route::get('/artes/nova', function(){
       return view('artes.novo');
    });
    Route::post('/artes/store',"ArteController@store");
    Route::post('/artes/update/{id}',"ArteController@update");

    /*/EQUIPES/*/
    Route::get("/equipes","EquipeController@index");
    Route::get("/equipe/novo","EquipeController@create");
    Route::post("/equipe/add","EquipeController@store");
    Route::get("/equipe/{id}","EquipeController@edit");
    Route::put('/equipe/update/{equipe}',"EquipeController@update");
    Route::get('/equipe/delete/{equipe}',"EquipeController@destroy");

    /*/AVISOS/*/
    Route::get("/avisos","AvisoController@index");
    Route::get("/avisos/novo","AvisoController@create");
    Route::post("/avisos/add","AvisoController@store");
    Route::get("/avisos/{id}","AvisoController@edit");
    Route::put('/avisos/update/{aviso}',"AvisoController@update");
    Route::get('/avisos/delete/{aviso}',"AvisoController@destroy");

    /*/Canais/*/
    Route::get("/canal","CanalController@index");
    Route::get("/canal/novo","CanalController@create");
    Route::post("/canal/add","CanalController@store");
    Route::get("/canal/{id}","CanalController@edit");
    Route::put('/canal/update/{canal}',"CanalController@update");
    Route::get('/canal/delete/{canal}',"CanalController@destroy");

    /*//Estagios/*/
    Route::get("/estagio","EstagioController@index");
    Route::get("/estagio/novo","EstagioController@create");
    Route::post("/estagio/add","EstagioController@store");
    Route::get("/estagio/{id}","EstagioController@edit");
    Route::put('/estagio/update/{estagio}',"EstagioController@update");
    Route::get('/estagio/delete/{estagio}',"EstagioController@destroy");

    /*/Usuários/*/
    Route::get('/users',"UsersController@index");
    Route::get('/users/novo',"UsersController@create");
    Route::post('/users/add',"UsersController@store");
    Route::get('/users/{id}',"UsersController@edit");
    Route::put('/users/update/{user}',"UsersController@update");
    Route::get('/users/delete/{user}',"UsersController@destroy");

   /*/Relatórios/*/
   Route::get('/relatorios/matriculas',function(){
    return view('relatorios.matriculas');
    });

});

Route::middleware(['cors'])->group(function(){
    Route::post('/api/export',"ApiController@export");
    Route::post('/api/lead', 'ApiController@leadsStation');
    Route::post('/api/lead-ipatinga', 'ApiController@leadsIpatinga');
    Route::post('/api/refer', 'ApiController@leadsLoja');
    Route::post('/api/lead-assertiva', 'ApiController@leadsAssertiva');
    Route::get('/api/chart-matriculas',"ApiController@chartSales");
    Route::get('/auth/callback', function(){
        echo 'ok';
    });

    /* Route::get('/home', 'HomeController@index')->name('home'); */

    //JOGAR PARA MIDDLEWARE NA PRODUÇÃO
    Route::post('/api/analise',"ApiController@analise");


    //EDUCA EDU
    Route::post('/api/edu',"ApiController@leadsEducaEdu");

    Route::get('/relatorios/matriculas/report',"MatriculaController@reportAdmin");
});