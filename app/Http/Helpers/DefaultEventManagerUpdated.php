<?php

namespace App\Http\Helpers;

use Carbon\Carbon;
use Illuminate\Queue\Events\JobExceptionOccurred;
use Imtigger\LaravelJobStatus\EventManagers\DefaultEventManager;

class DefaultEventManagerUpdated extends DefaultEventManager
{
    public function exceptionOccurred(JobExceptionOccurred $event): void
    {
        $this->getUpdater()->update($event, [
            'status' => $event->job->attempts() == $event->job->maxTries() ? $this->getEntity()::STATUS_FAILED : $this->getEntity()::STATUS_RETRYING,
            'finished_at' => Carbon::now(),
            'output' => ['message' => $event->exception->getMessage()],
        ]);
    }
}
