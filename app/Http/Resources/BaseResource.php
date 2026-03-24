<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        if (is_null($this->resource)) {
            return [];
        }

        // 1. Chỉ lấy attributes của chính model này (không tự động kéo relation nếu chưa load)
        $attributes = $this->resource->attributesToArray();

        // 2. Thêm các trường $appends (is_discounted, images,...)
        foreach ($this->resource->getAppends() as $append) {
            $attributes[$append] = $this->resource->{$append};
        }

        // 3. Xử lý đa ngôn ngữ (Chỉ lặp qua danh sách $translatable)
        if (isset($this->resource->translatable)) {
            foreach ($this->resource->translatable as $field) {
                if (isset($attributes[$field]) && is_array($attributes[$field])) {
                    $attributes[$field] = $this->convertKeys($attributes[$field]);
                }
            }
        }

        // 4. Xử lý Relationship (CHỐNG VÒNG LẶP TẠI ĐÂY)
        // Chỉ xử lý những relation đã được Eager Load (ngăn N+1 và loop ngầm)
        foreach ($this->resource->getRelations() as $name => $relation) {
            // Nếu relation là một Collection (như collections của Product)
            if ($relation instanceof \Illuminate\Database\Eloquent\Collection) {
                $attributes[$name] = BaseResource::collection($relation);
            }
            // Nếu là một Model đơn lẻ
            elseif ($relation instanceof \Illuminate\Database\Eloquent\Model) {
                $attributes[$name] = new BaseResource($relation);
            }
        }

        return $attributes;
    }

    /**
     * Helper dùng để format nhanh bất kỳ mảng nào sang chuẩn zh-CN
     */
    public static function formatArray(array $data): array
    {
        if (! $data) {
            return [];
        }

        $formatted = [];
        $locales = config('app.available_locales', []);

        // zh_CN => zh-CN
        $localeMap = [];
        foreach ($locales as $loc) {
            $localeMap[$loc] = str_replace('_', '-', $loc);
        }

        foreach ($data as $key => $value) {
            $newKey = $localeMap[$key] ?? $key;

            if (is_array($value)) {
                $formatted[$newKey] = self::formatArray($value);
            } else {
                $formatted[$newKey] = $value;
            }
        }

        return $formatted;
    }

    protected function convertKeys(array $data): array
    {
        $formatted = [];
        foreach ($data as $key => $value) {
            // zh_CN -> zh-CN
            $newKey = str_replace('_', '-', $key);
            $formatted[$newKey] = is_array($value) ? $this->convertKeys($value) : $value;
        }

        return $formatted;
    }
}
