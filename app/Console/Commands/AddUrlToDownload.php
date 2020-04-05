<?php

namespace App\Console\Commands;

use App\Jobs\DownloaderJob;
use Illuminate\Console\Command;

class AddUrlToDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloads:add {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to download resource from url';

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
     * @return void
     */
    public function handle()
    {
        DownloaderJob::dispatch($this->argument('url'));
        echo("download queued \n");
    }
}
