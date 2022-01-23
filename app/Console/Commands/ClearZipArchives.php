<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

    }
}
