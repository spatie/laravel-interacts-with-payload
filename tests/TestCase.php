<?php

namespace Spatie\InteractsWithPayload\Tests;

use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\InteractsWithPayload\InteractsWithPayloadServiceProvider;

class TestCase extends Orchestra
{
    public static Closure $executeInJob;

    public function setUp(): void
    {
        self::$executeInJob = fn() => null;

        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            InteractsWithPayloadServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        Schema::create('test_models', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
}
