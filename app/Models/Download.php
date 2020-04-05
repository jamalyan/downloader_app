<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Imtigger\LaravelJobStatus\JobStatus;

class Download extends Model
{
    protected $fillable = [
        'name',
        'job_id'
    ];

    /**
     * @return BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(JobStatus::class, 'job_id', 'id');
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        return $this->job->status;
    }
}
