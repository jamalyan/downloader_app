<?php

namespace App\Console\Commands;

use App\Models\Download;
use Illuminate\Console\Command;

class ListDownloads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloads:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List downloaded resources';

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
        $downloads = Download::with('job')->orderBy('created_at', 'desc')->get();
        foreach ($downloads as $download) {
            echo $download->name . '(' . $download->status . ')' . ($download->resource_url ? ' -> ' . $download->resource_url : '') . "\n";
        }
    }
}
