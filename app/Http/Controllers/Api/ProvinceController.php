<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\Ward;

class ProvinceController extends Controller
{
    private const API_PROVINCES_URL = 'https://provinces.open-api.vn/api/v2';
    private const API_WARDS_URL = 'https://provinces.open-api.vn/api/v2/w';

    /**
     * Synchronize provinces and wards from external API to database.
     */
    public function syncAll()
    {
        try {
            DB::transaction(function () {
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
            });

            return response()->json([
                'success' => true,
                'message' => 'Provinces and wards synchronized successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
