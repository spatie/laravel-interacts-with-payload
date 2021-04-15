<?php

namespace Spatie\InteractsWithPayload;

use Closure;

class AllJobs
{
    protected array $addToPayload = [];

    protected array $casts = [];

    public function add(array|string $name, Closure $closure): self
    {
        if (is_array($name)) {
            foreach($name as $nameInArray => $closureInArray) {
                $this->add($nameInArray, $closureInArray);
            }

            return $this;
        }

        $this->addToPayload[$name] = $closure;

        return $this;
    }

    public function cast(string $name, string $className): self
    {
        $this->casts[$name] = $className;

        return $this;
    }

    public function getCast($name): ?string
    {
        return $this->casts[$name] ?? null;
    }

    public function addAllToPayloadData(array $payloadData): array
    {
        foreach($this->addToPayload as $addToPayloadName => $addToPayloadClosure)
        {
            if (! isset($jobData[$addToPayloadName])) {
                $payloadData = array_merge($payloadData, array_filter([
                    $addToPayloadName => $addToPayloadClosure(),
                ]));
            }
        }

        return $payloadData;
    }
}
