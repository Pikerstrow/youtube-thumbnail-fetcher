<?php

namespace App\Console\Commands;

use App\ZipFileInfo;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ClearZipArchives extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clearZipArchives';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears all zip archives and zip_files_info table for everything that is older than 24 hours';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $dayAgo = Carbon::now()->subDay()->toDateTimeString();
            $archives = ZipFileInfo::where('created_at', '<', $dayAgo)->get();
            if (empty($archives)) {
                die;
            }
            $pathes = $archives->pluck('path')->toArray();
            foreach ($pathes as $path) {
                unlink($path);
            }
            ZipFileInfo::where('created_at', '<', $dayAgo)->delete();
        } catch (\Throwable $exception) {
            $message = 'File: ' . $exception->getFile() . ". Line: " . $exception->getLine() . ". Error message: " . $exception->getMessage();
            Log::channel('single')->info($message);
        }
    }
}
