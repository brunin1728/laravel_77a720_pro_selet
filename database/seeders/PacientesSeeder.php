<?php

namespace Database\Seeders;
use App\Models\PacienteModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        if(!PacienteModel::first()){
            PacienteModel::create([
                'id' => '1',
                'nome_completo' => 'Bruno',
                'nome_mae' => 'Bruno',
                'data_nascimento' => 'Bruno',
                'cpf' => 'Bruno',
                'cns' => 'Bruno',
                'codigo_aleatorio' => 'a687s14f6g4w414f1s25as1',
                'created_at' => '2024-02-26 21:35:02',
            ]);
        }
    }
}
