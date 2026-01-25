<?php

namespace App\Data;

use Illuminate\Http\Request;

class SearchParams
{
    public int $perPage = 15;
    public int $page = 1;
    public string $sortBy = 'id';
    public string $sortDirection = 'desc';

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public static function fromRequest(Request $request): static
    {
        $instance = new static();
        foreach ($instance->toArray() as $key => $_) {
            $value = $request->input($key);

            if ($value === null) continue;

            if (property_exists($instance, $key)) {
                $reflection = new \ReflectionProperty($instance, $key);
                $type = $reflection->getType();
                if ($type && !$type->isBuiltin()) {
                    $className = $type->getName();
                    if (enum_exists($className)) {
                        $value = $className::tryFrom($value);
                    }
                }

                if ($type && $type->getName() === 'array' && !is_array($value)) {
                    $value = [];
                }

                $instance->$key = $value;
            }
        }
        return $instance;
    }

    public static function fromArray(array $data): static
    {
        $instance = new static();
        foreach ($data as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->$key = $value;
            }
        }
        return $instance;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key) && $value !== null) {
                $this->$key = $value;
            }
        }
    }
}
