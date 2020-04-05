<?php

namespace App\Console\Commands;

use App\Http\Helpers\DownloadHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class AddUrlToDownload extends Command
{
    use  DownloadHelper;

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
     * @return bool
     */
    public function handle()
    {
        $validator = Validator::make(['url' => $this->argument('url')], ['url' => 'required|string|url']);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }

        $this->createDownloadJob($this->argument('url'));
        echo("download queued \n");
        return true;
    }
}
