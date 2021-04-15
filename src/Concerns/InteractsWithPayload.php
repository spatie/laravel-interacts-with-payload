<?php

namespace Spatie\InteractsWithPayload\Concerns;

use Illuminate\Database\Eloquent\Model;

trait InteractsWithPayload
{
    public function getFromPayload(string $name): mixed
    {
        $payload = $this->job->payload();

        $valueAndType = $payload['data'][$name] ?? null;

        if (is_null($valueAndType)) {
            return null;
        }

        return $this->castPayloadValue($name, $valueAndType);
    }

    protected function castPayloadValue(string $name, array $valueAndType)
    {
        ['value' => $value, 'type' => $type] = $valueAndType;

        if (is_subclass_of($type, Model::class)) {
            return $type::find($value);
        }

        return $value;
    }
}
