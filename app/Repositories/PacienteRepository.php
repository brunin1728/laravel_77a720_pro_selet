<?php

namespace App\Repositories;
use App\Helpers\LogHelper;
use App\Models\PacienteModel;
use App\Models\PacienteEnderecoModel;
use Carbon\Carbon;

class PacienteRepository
{

    public $pacienteModel;
    public $pacienteEnderecoModel;

    public function __construct(
        PacienteModel $pacienteModel,
        PacienteEnderecoModel $pacienteEnderecoModel
        )
    {
        $this->pacienteModel = $pacienteModel;
        $this->pacienteEnderecoModel = $pacienteEnderecoModel;
    }



    public function buscarPacientePorId($id){
   
    try {

        return $this->pacienteModel->where('id', $id)->first();

    } catch (\Illuminate\Database\QueryException $e) {

        LogHelper::log('error', json_encode([
            'titulo'    => 'Houve um erro ao tentar buscar os dados!',
            'payload'   => 'Classe: PacienteRepository - Método: buscarPacientePorId',
            'descricao' => $e->getMessage(),
        ]));

        return "Erro, verifique o log.";

    }
           
        
    }


    public function buscarTodosOsPaciente(){
   
    try {

        return $this->pacienteModel->get();

    } catch (\Illuminate\Database\QueryException $e) {

        LogHelper::log('error', json_encode([
            'titulo'    => 'Houve um erro ao tentar buscar os dados!',
            'payload'   => 'Classe: PacienteRepository - Método: buscarTodosOsPaciente',
            'descricao' => $e->getMessage(),
        ]));

        return "Erro, verifique o log.";

    }
           
        
    }

    
    public function deletarPaciente($id){
   
    try {

        $this->pacienteModel->where('id', $id)->delete();
        return "Paciente deletado com sucesso!";

    } catch (\Illuminate\Database\QueryException $e) {

        LogHelper::log('error', json_encode([
            'titulo'    => 'Houve um erro ao tentar deletar o paciente!',
            'payload'   => 'Classe: PacienteRepository - Método: deletarPaciente',
            'descricao' => $e->getMessage(),
        ]));

        return "Erro, verifique o log.";

    }
           
        
    }


    public function salvarPaciente($dados,$image = null){
     
    try {

        $codigo = md5(Carbon::now().rand(1,100));
       
        if($image == null){
            $data = [
                'nome_completo' => $dados->nome_completo,
                'nome_mae' => $dados->nome_mae,
                'data_nascimento' => $dados->data_nascimento,
                'cpf' => $dados->cpf,
                'cns' => $dados->cns,
                'codigo_aleatorio' => $codigo,
                'created_at' => Carbon::now(),
            ];
        }else{
            $data = [
                'foto' => $image,
                'nome_completo' => $dados->nome_completo,
                'nome_mae' => $dados->nome_mae,
                'data_nascimento' => $dados->data_nascimento,
                'cpf' => $dados->cpf,
                'cns' => $dados->cns,
                'codigo_aleatorio' => $codigo,
                'created_at' => Carbon::now(),
            ];
        }
       

     



        $this->pacienteModel->insert($data);

        $retorno = $this->pacienteModel->where('codigo_aleatorio', $codigo)->first();
              return $retorno->id;


    } catch (\Illuminate\Database\QueryException $e) {

        LogHelper::log('error', json_encode([
            'titulo'    => 'Houve um erro ao tentar salvar!',
            'payload'   => 'Classe: PacienteRepository - Método: salvarPaciente',
            'descricao' => $e->getMessage(),
        ]));
         
        return "Erro, verifique o log.";

    }
           
        
    }


    public function updatePaciente($dados){
     
    try {

       
        $data = [
            'nome_completo' => $dados->nome_completo,
            'nome_mae' => $dados->nome_mae,
            'data_nascimento' => $dados->data_nascimento,
            'cpf' => $dados->cpf,
            'cns' => $dados->cns,
            'updated_at' => Carbon::now(),
        ];



        $this->pacienteModel->where('id', $dados->id)->update($data);

        
              return 'Atualizado com Sucesso!';


    } catch (\Illuminate\Database\QueryException $e) {

        LogHelper::log('error', json_encode([
            'titulo'    => 'Houve um erro ao tentar atualizar o paciente!',
            'payload'   => 'Classe: PacienteRepository - Método: updatePaciente',
            'descricao' => $e->getMessage(),
        ]));
         
        return "Erro, verifique o log.";

    }
           
        
    }


    public function updateEnderecoPacientePorId($dados){
     
    try {

       
        $data = [
            'cep' => $dados->cep,
            'endereco' => $dados->endereco,
            'numero' => $dados->numero,
            'complemento' => $dados->complemento,
            'bairro' => $dados->bairro,
            'cidade' => $dados->cidade,
            'estado' => $dados->estado,
            'updated_at' => Carbon::now(),
        ];



        $this->pacienteEnderecoModel->where('id', $dados->id)->update($data);

        
              return 'Atualizado com Sucesso!';


    } catch (\Illuminate\Database\QueryException $e) {

        LogHelper::log('error', json_encode([
            'titulo'    => 'Houve um erro ao tentar atualizar o endereço do paciente!',
            'payload'   => 'Classe: PacienteRepository - Método: updateEnderecoPacientePorId',
            'descricao' => $e->getMessage(),
        ]));
         
        return "Erro, verifique o log.";

    }
           
        
    }


    public function salvarEnderecoPaciente($dados,$id){
     
    try {

         
        $data = [
            'id_paciente' => $id,
            'cep' => $dados->cep,
            'endereco' => $dados->endereco,
            'numero' => $dados->numero,
            'complemento' => $dados->complemento,
            'bairro' => $dados->bairro,
            'cidade' => $dados->cidade,
            'estado' => $dados->estado,
            'created_at' => Carbon::now(),
        ];


        $this->pacienteEnderecoModel->insert($data);
 
        return "Sucesso!";


    } catch (\Illuminate\Database\QueryException $e) {

        LogHelper::log('error', json_encode([
            'titulo'    => 'Houve um erro ao tentar salvar!',
            'payload'   => 'Classe: PacienteRepository - Método: salvarEnderecoPaciente',
            'descricao' => $e->getMessage(),
        ]));
        
        return "Erro, verifique o log.";

    }
           
        
    }



}