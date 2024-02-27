<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;




Route::get('consultar-cep/{cep}',                   [PacienteController::class, 'consultarCep']);


Route::prefix('paciente')->group(function() {
    Route::post('cadastrar-lista-csv',              [PacienteController::class, 'cadastrarPacientesListaCsv']);
    Route::post('cadastrar',                        [PacienteController::class, 'cadastrarPaciente']);
    Route::post('atualizar',                        [PacienteController::class, 'updatePaciente']);
    Route::post('atualizar-endereco-id',            [PacienteController::class, 'updateEnderecoPacientePorId']);
    Route::post('cadastrar-endereco-paciente',      [PacienteController::class, 'cadastrarEnderecoPaciente']);
    Route::post('deletar',                          [PacienteController::class, 'deletarPaciente']);
    Route::get('listar-todos',                      [PacienteController::class, 'buscarTodosOsPaciente']);
});
