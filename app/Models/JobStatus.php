<?php


namespace App\Models;

use Imtigger\LaravelJobStatus\JobStatus as JobStatusOriginal;

class JobStatus extends JobStatusOriginal
{
    const STATUS_QUEUED = 'pending';
    const STATUS_EXECUTING = 'downloading';
    const STATUS_FINISHED = 'complete';
    const STATUS_FAILED = 'error';
    const STATUS_RETRYING = 'retrying';
}
