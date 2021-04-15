<?php

namespace Spatie\InteractsWithPayload\Tests;

use Spatie\InteractsWithPayload\Facades\AllJobs;
use Spatie\InteractsWithPayload\Tests\TestClasses\TestJob;
use Spatie\InteractsWithPayload\Tests\TestClasses\TestModel;

class AllJobsTest extends TestCase
{
    protected mixed $valueFromInsideJob = null;

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

    /** @test */
    public function it_will_not_blow_up_when_no_value_has_been_set()
    {
        self::$executeInJob = function (TestJob $job) {
            $this->valueFromInsideJob = $job->getFromPayload('extra');
        };

        dispatch(new TestJob());

        $this->assertNull($this->valueFromInsideJob);
    }

    /** @test */
    public function it_can_automatically_serialize_models()
    {
        $myModel = TestModel::create(['name' => 'my model name']);

        self::$executeInJob = function (TestJob $job) {
            $this->valueFromInsideJob = $job->getFromPayload('myModel');
        };

        AllJobs::add('myModel', fn () => $myModel);

        dispatch(new TestJob());

        $this->assertInstanceOf(TestModel::class, $this->valueFromInsideJob);
        $this->assertEquals('my model name', $this->valueFromInsideJob->name);
    }

    /** @test */
    public function it_an_handle_an_array()
    {
        self::$executeInJob = function (TestJob $job) {
            $this->valueFromInsideJob = $job->getFromPayload('extra');
        };

        AllJobs::add('extra', fn () => ['a' => 1]);

        dispatch(new TestJob());

        $this->assertIsArray($this->valueFromInsideJob);
        $this->assertEquals(1, $this->valueFromInsideJob['a']);
    }

    /** @test */
    public function multiple_things_can_be_added_to_a_job_in_one_go()
    {
        $myModel = TestModel::create(['name' => 'my model name']);

        AllJobs::add([
            'extra' => fn() => 'extra value',
            'model' => fn() => $myModel,
        ]);

        self::$executeInJob = function (TestJob $job) {
            $this->valueFromInsideJob = [
                'extra' => $job->getFromPayload('extra'),
                'model' => $job->getFromPayload('model'),
            ];
        };

        dispatch(new TestJob());

        $this->assertEquals('extra value', $this->valueFromInsideJob['extra']);
        $this->assertEquals('my model name', $this->valueFromInsideJob['model']->name);

    }
}
