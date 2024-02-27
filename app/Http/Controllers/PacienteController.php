<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\External\ViaCepApiService;
use App\Services\PacienteService;
use Illuminate\Http\Request;


class PacienteController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $viaCepApiService;
    public $pacienteService;

    public function __construct(
        ViaCepApiService $viaCepApiService,
        PacienteService $pacienteService
                                )
    {
        $this->viaCepApiService = $viaCepApiService;
        $this->pacienteService = $pacienteService;
    }

    
    public function cadastrarPaciente(Request $request){
        
        $imagem = null;
        if($request->file('imagem')){
            $image = $request->file('imagem')->store('pacientes');
            $image = explode("/", $image);
            $imagem = $image[1];
        }
       
      
       
        return $this->pacienteService->salvarPaciente($request,$imagem);
       
    }
    
    public function cadastrarPacientesListaCsv(Request $request){
   
        return $this->pacienteService->cadastrarPacientesListaCsv($request);
       
    }

    public function updatePaciente(Request $request){
   
        return $this->pacienteService->updatePaciente($request);
       
    }

    public function updateEnderecoPacientePorId(Request $request){
   
        return $this->pacienteService->updateEnderecoPacientePorId($request);
       
    }

    public function cadastrarEnderecoPaciente(Request $request){
   
        return $this->pacienteService->cadastrarEnderecoPaciente($request);
       
    }

    public function deletarPaciente(Request $request){
   
        return $this->pacienteService->deletarPaciente($request->id);
       
    }

    
    public function buscarTodosOsPaciente(){
   
        return $this->pacienteService->buscarTodosOsPaciente();
       
    }

    public function consultarCep(Request $request){
        
        return $this->viaCepApiService->consultarCep($request->cep);
       
    }
    
}
