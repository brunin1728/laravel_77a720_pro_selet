<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Repositories\PacienteRepository;
use App\Services\External\ViaCepApiService;
use App\Jobs\ProcessarListaCsvJob;

class PacienteService
{
    protected $pacienteRepository;
    protected $viaCepApiService;
    protected $endereco;

    public function __construct(
        PacienteRepository $pacienteRepository,
        ViaCepApiService $viaCepApiService
        )
    {
        $this->pacienteRepository = $pacienteRepository;
        $this->viaCepApiService = $viaCepApiService;
    }


    public function cadastrarPacientesListaCsv($request)
    {
        
        $lista = Array();
        $file = fopen($request->arquivo, 'r');
        while (($line = fgetcsv($file)) !== false)
        {
        $lista[] = $line;
        }
        fclose($file);

        $i=0;
      
        foreach($lista as $d){

            if($i!=0){
                ProcessarListaCsvJob::dispatch($d[0]);
            }
            
            $i++;
        }
        
        return ResponseHelper::getResponseSucesso("Enviado com sucesso!");
	}


    public function salvarPacienteCsv($data)
    {
       
        
        $dados = explode(";", $data);
        
        $data = (object)array(
            'nome_completo' => $dados[0],
            'nome_mae' => $dados[1],
            'data_nascimento' => $dados[2],
            'cpf' => $dados[3],
            'cns' => $dados[4],
            'cep' => $dados[5],
            'endereco' => $dados[6],
            'numero' => $dados[7],
            'complemento' => $dados[8],
            'bairro' => $dados[9],
            'cidade' => $dados[10],
            'estado' => $dados[11],
        );

        
        
		$retorno_id = $this->pacienteRepository->salvarPaciente($data);

		return ResponseHelper::getResponseSucesso($this->pacienteRepository->salvarEnderecoPaciente($data,$retorno_id));

	}


    public function salvarPaciente($request,$image = null)
    {
        if($request->nome_completo == null || $request->nome_mae == null || $request->data_nascimento == null 
        || $request->cpf == null || $request->cns == null || $request->cep == null || $request->endereco == null
        || $request->numero == null || $request->complemento == null || $request->bairro == null || $request->cidade == null || $request->estado == null)
           return ResponseHelper::getResponseSucesso("Por favor, envie todos os campos obrigátorios.");

        
        
		$retorno_id = $this->pacienteRepository->salvarPaciente($request,$image);

		return ResponseHelper::getResponseSucesso($this->pacienteRepository->salvarEnderecoPaciente($request,$retorno_id));

	}


    public function updatePaciente($request)
    {
        if($request->id == null || $request->nome_completo == null || $request->nome_mae == null || $request->data_nascimento == null 
        || $request->cpf == null || $request->cns == null)
           return ResponseHelper::getResponseSucesso("Por favor, envie todos os campos obrigátorios.");


		return ResponseHelper::getResponseSucesso($this->pacienteRepository->updatePaciente($request));

	}


    public function updateEnderecoPacientePorId($request)
    {
        if($request->id == null || $request->cep == null || $request->endereco == null
        || $request->numero == null || $request->complemento == null || $request->bairro == null
        || $request->cidade == null || $request->estado == null)
           return ResponseHelper::getResponseSucesso("Por favor, envie todos os campos obrigátorios.");


		return ResponseHelper::getResponseSucesso($this->pacienteRepository->updateEnderecoPacientePorId($request));

	}


    public function cadastrarEnderecoPaciente($request)
    {
        if($request->id_paciente == null || $request->cep == null || $request->endereco == null
        || $request->numero == null || $request->complemento == null || $request->bairro == null
        || $request->cidade == null || $request->estado == null)
           return ResponseHelper::getResponseSucesso("Por favor, envie todos os campos obrigátorios.");


		return ResponseHelper::getResponseSucesso($this->pacienteRepository->salvarEnderecoPaciente($request,$request->id_paciente));

	}



    public function deletarPaciente($id)
    {
        if($id == null)
           return ResponseHelper::getResponseSucesso("Por favor, informe um id.");

        
        
		return ResponseHelper::getResponseSucesso($this->pacienteRepository->deletarPaciente($id));


	}



      public function buscarPacientePorId($id)
    {
      
        return ResponseHelper::getResponseSucesso($this->pacienteRepository->buscarPacientePorId($id));

	}



      public function buscarTodosOsPaciente()
    {
      
        return ResponseHelper::getResponseSucesso($this->pacienteRepository->buscarTodosOsPaciente());

	}

  
    
}
