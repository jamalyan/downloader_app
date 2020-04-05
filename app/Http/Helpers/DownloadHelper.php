<?php

namespace App\Http\Helpers;

use App\Jobs\DownloaderJob;
use App\Models\Download;

trait DownloadHelper
{
    /**
     * @param $url
     * @return bool
     */
    public function createDownloadJob($url)
    {
        $name = time() . '_' . substr($url, strrpos($url, '/') + 1);
        $job = new DownloaderJob($url, $name);

        Download::query()->create([
            'name' => $name,
            'url' => $url,
            'job_id' => $job->getJobStatusId(),
        ]);

        dispatch($job);

        return true;
    }
}
