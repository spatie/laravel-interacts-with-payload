<?php

namespace Spatie\InteractsWithPayload\Tests;

use Spatie\InteractsWithPayload\Facades\AllJobs;
use Spatie\InteractsWithPayload\Tests\TestClasses\TestJob;

class AllJobsTest extends TestCase
{
    protected ?string $valueFromInsideJob = null;

    /** @test */
    public function it_can_inject_a_value_in_all_jobs()
    {
        self::$executeInJob = function (TestJob $job) {
            $this->valueFromInsideJob = $job->getFromPayload('extra');
        };

        AllJobs::add('extra', fn () => 'extraValue');

        dispatch(new TestJob());

        $this->assertEquals('extraValue', $this->valueFromInsideJob);
    }
}
