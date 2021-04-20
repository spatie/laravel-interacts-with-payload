# Add variables to the payloads of all jobs in a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-interacts-with-payload.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-interacts-with-payload)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-interacts-with-payload/run-tests?label=tests)](https://github.com/spatie/laravel-interacts-with-payload/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-interacts-with-payload/Check%20&%20fix%20styling?label=code%20style)](https://github.com/spatie/laravel-interacts-with-payload/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-interacts-with-payload.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-interacts-with-payload)

This package makes it easy to inject things in every job. 

Imagine that you want to have the user who initiated the queued of a job available in every queued job. This is how you would implement that using this package.

```php
// typically in a service provider

use Spatie\InteractsWithPayload\Facades\AllJobs;

AllJobs::add('user', fn() => auth()->user());
```

To retrieve the user in your queued job you can call `getFromPayload` which is available through the `InteractsWithPayload` trait.

```php
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\InteractsWithPayload\Concerns\InteractsWithPayload;

class YourJob implements ShouldQueue
{
    use InteractsWithPayload;  
    
    public function handle()
    {
        // instance of User model or `null`
        $user = $this->getFromPayload('user');
    }  
}
```

## Are you a visual learner?

[In this livestream](https://youtu.be/DY8i5eaXCbM?t=1688), you'll see our developer Freek explains how you can use the package, it's internals and how we test this package.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-interacts-with-payload.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-interacts-with-payload)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-interacts-with-payload
```

## Usage

To add a value to all jobs call the `add` method on the `AllJobs` facade with a name and a closure that returns the value.

```php
use Spatie\InteractsWithPayload\Facades\AllJobs;

AllJobs::add('extraValue', fn() => 'My extra value')
```

To retrieve the user in your queued job you can call `getFromPayload` which is available through the `InteractsWithPayload` trait.

```php
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\InteractsWithPayload\Concerns\InteractsWithPayload;

class YourJob implements ShouldQueue
{
    use InteractsWithPayload;  
    
    public function handle()
    {
        // will contain "My extra value"
        $value = $this->getFromPayload('extraValue');
    }  
}
```

### Using models

It is safe to let the closure you pass to `add` return an Eloquent model. 

```php
use Spatie\InteractsWithPayload\Facades\AllJobs;

AllJobs::add('user', fn() => auth()->user())
```

You can retrieve the model with `getFromPayload`

```php
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\InteractsWithPayload\Concerns\InteractsWithPayload;

class YourJob implements ShouldQueue
{
    use InteractsWithPayload;  
    
    public function handle()
    {
        // instance of User model or `null` if the user has been deleted in the meantime
        $user = $this->getFromPayload('user');
    }  
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

This package is inspired by [this awesome blogpost](https://james.brooks.page/blog/injecting-additional-data-into-laravel-queued-jobs/) by [James Brooks](https://twitter.com/jbrooksuk). Thank you James for also having helped hunting down that queueing bug in Laravel 👍

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
