<?php

namespace Spatie\InteractsWithPayload\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\InteractsWithPayload\AllJobs
 */
class AllJobs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'all-jobs';
    }
}
