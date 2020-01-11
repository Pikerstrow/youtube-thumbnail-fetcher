<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;



trait ExtendedLogging
{
    public function logError(\Throwable $e)
    {
        Log::channel('single')->info('File: ' . $e->getFile() . ". Line: " . $e->getLine() . ". Error message: " . $e->getMessage());
    }
}
