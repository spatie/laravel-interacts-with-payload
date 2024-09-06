<?php

namespace Spatie\InteractsWithPayload;

use Illuminate\Support\Facades\Queue;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InteractsWithPayloadServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel_interacts_with_payload');
    }

    public function packageRegistered()
    {
        $this->app->singleton('all-jobs', function () {
            return new AllJobs();
        });
        $this->app->alias('all-jobs', AllJobs::class);
    }

    public function packageBooted()
    {
        Queue::createPayloadUsing(function ($connection, $queue, $payload) {
            $payloadData = $payload['data'];

            /** @var \Spatie\InteractsWithPayload\AllJobs $allJobs */
            $allJobs = app('all-jobs');

            $modifiedPayloadData = $allJobs->addAllToPayloadData($payloadData);

            return ['data' => $modifiedPayloadData];
        });
    }
}
