<?php

namespace App\Http\Controllers;
use App\Formulario;
use App\Api;
use Illuminate\Http\Request;
use App\Mail\FormularioDeMatricula;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\PhpStreamRequestFactory;

class FormularioController extends Controller
{
    public function index($id){

        return view('formulario.index', ['lead' => \App\Lead::findOrFail($id)] );
    }

    public function envia(Request $res){
        $dados = $res->except('_token');
        $formulario = Formulario::create($dados);
        $comercial = $res->input('comercial');

        if( $comercial == 1){
            $to = 'cadastro@ibrasuperior.com.br';
        }
        
        if( $comercial == 2){
            $to = 'cadastro02@ibrasuperior.com.br';
        }

        if( $comercial == 3){
            $to = 'cadastro03@ibrasuperior.com.br';
        }

        if( $comercial == 4 ){
            $to = 'expansao@ibrasuperior.com.br';
        }

        Mail::to($to)->send(new FormularioDeMatricula($formulario));
        
        //ENVIA DADOS PARA RD STATION
        //URLS
        $url = 'https://api.rd.services/platform/contacts/email:'. $dados['email']  .'/funnels/default' ;
        $urlTokenRefresh = 'https://api.rd.services/auth/token' ;
    

        //ATUALIZANDO TOKEN
        //ATUALIZANDO TOKEN
        $api = Api::where('nome', 'RdStation')->first();

        $client_id = $api->client_id;
        $client_secret = $api->client_secret;
        $refresh_token = $api->refresh_token;

        $refreshData = array();
        $refreshData['client_id'] =  $client_id;
        $refreshData['client_secret'] = $client_secret;
        $refreshData['refresh_token'] = $refresh_token ;

        $refreshBody = json_encode($refreshData);

        try{
        $client2 = new GuzzleClient();
        $request2 = new GuzzleRequest('POST', $urlTokenRefresh, [
            'Content-Type' => 'application/json'
        ], $refreshBody );

        $response = $client2->send($request2);
        
        $refresh = $response->getBody()->getContents();
        $json = json_decode($refresh, true);
        
        Api::where('nome', 'RdStation' )->update([
            'access_token' => $json['access_token']
        ]);

            //ENVIA OS DADOS PARA RD STATION
            //ENVIA OS DADOS PARA RD STATION
            $token = Api::where('nome', 'RdStation')->first();

            $headers = [
                'Authorization' => ['Baerer '.$token->access_token],
                'Content-Type' => 'application/json'
            ];
            $data = array();
            $data['lifecycle_stage'] = "Client";
            $data['opportunity'] = false;
            $data['contact_owner_email'] = null;

            $body = json_encode($data);

            $client = new GuzzleClient();
            $request = new GuzzleRequest('PUT', $url, $headers, $body );
            $client->send($request);
            
            return redirect('/');
        }
            catch (RequestException $e) {
                return redirect('/');
            }
        
    }
}
