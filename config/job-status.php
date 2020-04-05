<?php

return [
    'model' => \App\Models\JobStatus::class,
    'event_manager' => \App\Http\Helpers\DefaultEventManagerUpdated::class,
    'database_connection' => null
];
