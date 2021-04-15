<?php

namespace Spatie\InteractsWithPayload\Concerns;

use Illuminate\Database\Eloquent\Model;
use Spatie\InteractsWithPayload\Facades\AllJobs;

trait InteractsWithPayload
{
    public function getFromPayload(string $name): mixed
    {
        $payload = $this->job->payload();

        $value = $payload['data'][$name] ?? null;

        $this->castPayloadValue($name, $value);

        return $value;
    }

    protected function castPayloadValue(string $name, mixed $value)
    {
        if (! $castToClass = AllJobs::getCast($name)) {
            return $value;
        }

        if (is_subclass_of($castToClass, Model::class)) {
            return $castToClass::find($value);
        }

        return new $castToClass($value);
    }
}
