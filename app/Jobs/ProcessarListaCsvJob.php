<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\PacienteService;
use App\Helpers\LogHelper;

class ProcessarListaCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dados = array();

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Execute the job.
     */
    public function handle(PacienteService $pacienteService)
    {
        LogHelper::log('info', 'Processando dados da lista csv: ' . $this->dados) ;
        $pacienteService->salvarPacienteCsv($this->dados);
    }
}
