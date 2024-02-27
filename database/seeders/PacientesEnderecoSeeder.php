<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PacienteEnderecoModel;

class PacientesEnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!PacienteEnderecoModel::first()){
            PacienteEnderecoModel::create([
                'id_paciente' => '1',
                'cep' => '25961-143',
                'endereco' => 'Avenida Oliveira Botelho',
                'numero' => '131',
                'complemento' => 'até 279 - lado ímpar',
                'bairro' => 'Alto',
                'cidade' => 'Teresópolis',
                'estado' => 'Rio de Janeiro',
                'created_at' => '2024-02-26 21:35:02'
            ]);
        }
    }
}
