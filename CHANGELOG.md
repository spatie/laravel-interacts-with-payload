# Changelog

All notable changes to `laravel-interacts-with-payload` will be documented in this file.

## 1.3.0 - 2026-11-06

### Requirements

- Requires PHP 8.3+ and Laravel 13.30+.
- Retires PHP 8.2 and Laravel 10–12 support as authorized by the maintainer. Applications on older runtimes should remain on the 1.2.x line.
- Requires Carbon 3.8.4+ and Laravel Package Tools 1.93.0+.

### Changes

- Adds Laravel 13 compatibility without changing the public payload API or production source behavior.
- Tests PHP 8.3, 8.4, 8.5 and actual 8.6 on Ubuntu and Windows with both lowest and stable dependencies.
- Upgrades Testbench/PHPUnit tooling and removes unused Ray development tooling.
- Expands queued-payload round-trip coverage to false, zero, empty strings, null and nested arrays, retaining model serialization and all previous assertions.
- Keeps strict output checks, failOnRisky, security blocking and full deprecation visibility enabled.

### Verification

All 17 checks passed on the exact PR head: 16 runtime/dependency/OS jobs, each with 10 tests and 13 assertions, plus styling. Local full retained matrix, strict Composer validation/platform/audit checks and production-only consumer probes passed.

PR: https://github.com/spatie/laravel-interacts-with-payload/pull/9
Full changelog: https://github.com/spatie/laravel-interacts-with-payload/compare/1.2.2...1.3.0

## 1.2.2 - 2025-03-08

### What's Changed

* Laravel 12.x Compatibility by @laravel-shift in https://github.com/spatie/laravel-interacts-with-payload/pull/6

**Full Changelog**: https://github.com/spatie/laravel-interacts-with-payload/compare/1.2.1...1.2.2

## 1.2.1 - 2024-12-11

### What's Changed

* Add alias for AllJobs by @demianbinsh in https://github.com/spatie/laravel-interacts-with-payload/pull/5
* Use InteractsWithQueue by @demianbinsh in https://github.com/spatie/laravel-interacts-with-payload/pull/4

### New Contributors

* @demianbinsh made their first contribution in https://github.com/spatie/laravel-interacts-with-payload/pull/5

**Full Changelog**: https://github.com/spatie/laravel-interacts-with-payload/compare/1.2.0...1.2.1

## 1.2.0 - 2024-03-08

### What's Changed

* Laravel 11.x Compatibility by @laravel-shift in https://github.com/spatie/laravel-interacts-with-payload/pull/3

**Full Changelog**: https://github.com/spatie/laravel-interacts-with-payload/compare/1.1.2...1.2.0

## 1.1.2 - 2023-02-02

### What's Changed

- Laravel 10.x Compatibility by @laravel-shift in https://github.com/spatie/laravel-interacts-with-payload/pull/2

### New Contributors

- @laravel-shift made their first contribution in https://github.com/spatie/laravel-interacts-with-payload/pull/2

**Full Changelog**: https://github.com/spatie/laravel-interacts-with-payload/compare/1.1.1...1.1.2

## 1.1.1 - 2022-04-29

## What's Changed

- Fix variable name by @joelvh in https://github.com/spatie/laravel-interacts-with-payload/pull/1

## New Contributors

- @joelvh made their first contribution in https://github.com/spatie/laravel-interacts-with-payload/pull/1

**Full Changelog**: https://github.com/spatie/laravel-interacts-with-payload/compare/1.1.0...1.1.1

## 1.1.0 - 2022-01-13

- support Laravel 9

## 1.0.1 - 2021-04-20

- fix package discovery

## 1.0.0 - 2021-04-20

- initial release
