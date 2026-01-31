<?php

namespace App\Services;

use App\Models\Province;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProvinceService
{
    private const API_PROVINCES_URL = 'https://provinces.open-api.vn/api/v2';
    private const API_WARDS_URL = 'https://provinces.open-api.vn/api/v2/w';

    /**
     * Synchronize provinces and wards from external API to database.
     *
     * @return array
     * @throws \Exception
     */
    public function syncAll(): array
    {
        return DB::transaction(function () {
            // Delete old data
            Province::query()->delete();

            // Get list provinces
            $provinceResponse = Http::get(self::API_PROVINCES_URL);
            if ($provinceResponse->failed()) {
                throw new \Exception('Failed to fetch provinces.');
            }
            $provinceList = $provinceResponse->json();
            $provinceMap = [];

            foreach ($provinceList as $provinceData) {
                $province = Province::create([
                    'code' => $provinceData['code'],
                    'codename' => $provinceData['codename'] ?? null,
                    'division_type' => $provinceData['division_type'] ?? null,
                    'name' => $provinceData['name'] ?? null,
                    'phone_code' => $provinceData['phone_code'] ?? null,
                ]);

                $provinceMap[$provinceData['code']] = $province->id;
            }

            // Get list wards
            $wardResponse = Http::get(self::API_WARDS_URL);
            if ($wardResponse->failed()) {
                throw new \Exception('Failed to fetch wards.');
            }
            $wardList = $wardResponse->json();

            foreach ($wardList as $wardData) {
                $provinceId = $provinceMap[$wardData['province_code']] ?? null;

                Ward::create([
                    'code' => $wardData['code'],
                    'codename' => $wardData['codename'] ?? null,
                    'division_type' => $wardData['division_type'] ?? null,
                    'name' => $wardData['name'] ?? null,
                    'province_id' => $provinceId,
                ]);
            }

            // Callback after commit (only run if transaction successful)
            DB::afterCommit(function () use ($provinceList, $wardList) {
                logger()->info('Provinces and wards synchronized successfully.', [
                    'provinces' => count($provinceList),
                    'wards' => count($wardList),
                ]);
            });

            return [
                'provinces' => count($provinceList),
                'wards' => count($wardList),
            ];
        });
    }

    /**
     * Get all provinces.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProvinces()
    {
        return Province::orderBy('name')->get();
    }

    /**
     * Get wards by province.
     *
     * @param int $provinceId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWardsByProvince(int $provinceId)
    {
        return Ward::where('province_id', $provinceId)
            ->orderBy('name')
            ->get();
    }
}
