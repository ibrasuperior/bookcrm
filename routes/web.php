<?php

Route::middleware(['auth'])->group(function(){
    Route::get('/',"LeadsController@dashboard");

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
        return view('documentos.index');
    });


    //Formulario de matrícula
    Route::get('/formulario/{id}', 'FormularioController@index');
    Route::post('/formulario/envia', 'FormularioController@envia');

    /*/Relatórios/*/
    Route::get('/relatorios',"RelatoriosController@index");
    Route::get('/relatorios/matriculas',"RelatoriosController@matriculas");

    /*/API/*/
    Route::get('/api/midias',"ApiController@midia");
    Route::get('/api/users',"ApiController@users");
    Route::get('/api/user-attempt',"ApiController@userAttempt");
    Route::get('/api/estagios',"ApiController@estagios");


});

Auth::routes();

Auth::routes(['register' => false]);

Route::middleware(['security'])->group(function(){

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

    //EXPORTAR RELATÓRIOS
    Route::post('/report',"ApiController@report");
});


Route::post('/api/export',"ApiController@export");
Route::post('/api/lead', 'ApiController@leadsStation');
Route::get('/api/chart-matriculas',"ApiController@chartSales");
Route::get('/auth/callback', function(){
     echo 'ok';
});

 /* Route::get('/home', 'HomeController@index')->name('home'); */

 //JOGAR PARA MIDDLEWARE NA PRODUÇÃO
 Route::post('/api/analise',"ApiController@analise");

