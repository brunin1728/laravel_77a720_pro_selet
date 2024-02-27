<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

// Classe com utilitarios para string
class LogHelper
{    
  public static function log($nivel, $obj) {
    return Log::$nivel('[api] - ' . $obj);
  }    
} 
