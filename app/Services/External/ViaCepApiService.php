<?php

namespace App\Services\External;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helpers\ResponseHelper;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Http;



class ViaCepApiService
{
    protected $urlApi;
    protected $client;

    public function __construct()
    {
        $this->urlApi           = 'https://viacep.com.br/ws/';
        $this->client           = new Client(['verify' => false]);
    }

    public function consultarCep($cep)
    {
      
      $url =  $cep."/json/"; 
      return $this->sendRequest('GET', $url, null);
	}

    private function sendRequest ($metodo = "GET", $endpoint, $dados = [])
    {
      LogHelper::log('info', '*** sendRequest ***');
      $url = $this->urlApi . '/' . $endpoint;
      LogHelper::log('info', 'Url: ' . $url) ;
      LogHelper::log('info', 'Método: ' . $metodo);
      
              
      try {

        $response = $this->client->request($metodo, $url, [
          'headers' => [
            'content-type'    => 'application/x-www-form-urlencoded'
          ]
        ]);
        
        $response = $response->getBody()->getContents();
  
        LogHelper::log('info', 'Retorno da API: ' . $response);
        
        if ($response)
          $response = json_decode($response);
          return $response;

      } catch (\GuzzleHttp\Exception\RequestException $e) {
        $erro = array (
          'titulo'    => "Houve um erro ao tentar acessar a api: $endpoint",
          'payload'   => json_encode($dados),
          'descricao' =>  $e->getMessage()
        );
        LogHelper::log('error', json_encode($erro));
     
        return $erro;
      }
    } 
  

    
}
