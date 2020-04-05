<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Download extends Model
{
    protected $fillable = [
        'name',
        'url',
        'job_id'
    ];

    protected $visible = ['url', 'status', 'resource_url'];
    protected $appends = ['resource_url', 'status'];

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

    /**
     * @return string|null
     */
    public function getResourceUrlAttribute()
    {
        return Storage::disk('downloads')->exists($this->attributes['name']) ? url('storage/downloads/' . $this->attributes['name']) : null;
    }
}
