<?php

namespace App\Jobs;

use App\Models\Download;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Imtigger\LaravelJobStatus\Trackable;

class DownloaderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    public $tries = 2;
    protected $url;

    /**
     * Create a new job instance.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->prepareStatus();
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contents = file_get_contents($this->url);
        $name = time() . substr($this->url, strrpos($this->url, '/') + 1);
        Storage::disk('downloads')->put($name, $contents);
        Download::query()->create([
            'name' => $name,
            'job_id' => $this->getJobStatusId(),
        ]);
    }
}
