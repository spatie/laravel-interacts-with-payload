<?php

namespace Spatie\InteractsWithPayload\Tests\TestClasses;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\InteractsWithPayload\Concerns\InteractsWithPayload;
use Spatie\InteractsWithPayload\Tests\TestCase;

class TestJob implements ShouldQueue
{
    use InteractsWithQueue;
    use InteractsWithPayload;

    public function handle()
    {
        $closure = TestCase::$executeInJob;

        $closure($this);
    }
}
