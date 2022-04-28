<?php

namespace Spatie\InteractsWithPayload;

use Closure;
use Illuminate\Database\Eloquent\Model;

class AllJobs
{
    protected array $addToPayload = [];

    public function add(array | string $name, ?Closure $closure = null): self
    {
        if (is_array($name)) {
            foreach ($name as $nameInArray => $closureInArray) {
                $this->add($nameInArray, $closureInArray);
            }

            return $this;
        }

        $this->addToPayload[$name] = $closure;

        return $this;
    }

    public function addAllToPayloadData(array $payloadData): array
    {
        foreach ($this->addToPayload as $addToPayloadName => $addToPayloadClosure) {
            if (isset($payloadData[$addToPayloadName])) {
                continue;
            }

            $rawValue = $addToPayloadClosure();

            $preparedValue = $this->getPreparedValueForPayload($addToPayloadName, $rawValue);

            $payloadData = array_merge($payloadData, array_filter([

                $addToPayloadName => $preparedValue,
            ]));
        }

        return $payloadData;
    }

    protected function getPreparedValueForPayload(string $name, mixed $rawValue): array
    {
        if ($rawValue instanceof Model) {
            return ['value' => $rawValue->getKey(), 'type' => get_class($rawValue)];
        }

        return [
            'value' => $rawValue, 'type' => '',
        ];
    }
}
