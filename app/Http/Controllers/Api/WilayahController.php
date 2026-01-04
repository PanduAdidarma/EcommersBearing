<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahController extends Controller
{
    protected $baseUrl = 'https://wilayah.id/api';

    /**
     * Transform API response from wilayah.id format to consistent format
     * wilayah.id returns: { data: [{ code, name }], meta: {...} }
     */
    private function transformResponse($response)
    {
        if (!isset($response['data']) || !is_array($response['data'])) {
            return [];
        }

        return collect($response['data'])->map(function ($item) {
            return [
                'kode' => $item['code'],
                'nama' => $item['name']
            ];
        })->toArray();
    }

    /**
     * Get list of provinces
     */
    public function provinsi()
    {
        $cacheKey = "wilayah_provinsi";
        
        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () {
            $response = Http::timeout(10)->get("{$this->baseUrl}/provinces.json");
            
            if ($response->successful()) {
                return $this->transformResponse($response->json());
            }
            
            return [];
        });

        return response()->json($data);
    }

    /**
     * Get list of cities/kabupaten by province code
     */
    public function kota(Request $request)
    {
        $provinsiKode = $request->query('pro');
        
        if (!$provinsiKode) {
            return response()->json(['error' => 'Kode provinsi diperlukan'], 400);
        }

        $cacheKey = "wilayah_kota_{$provinsiKode}";
        
        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($provinsiKode) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/regencies/{$provinsiKode}.json");
            
            if ($response->successful()) {
                return $this->transformResponse($response->json());
            }
            
            return [];
        });

        return response()->json($data);
    }

    /**
     * Get list of kecamatan by regency/city code
     */
    public function kecamatan(Request $request)
    {
        $kotaKode = $request->query('kab');
        
        if (!$kotaKode) {
            return response()->json(['error' => 'Kode kabupaten/kota diperlukan'], 400);
        }

        $cacheKey = "wilayah_kecamatan_{$kotaKode}";
        
        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($kotaKode) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/districts/{$kotaKode}.json");
            
            if ($response->successful()) {
                return $this->transformResponse($response->json());
            }
            
            return [];
        });

        return response()->json($data);
    }

    /**
     * Get list of kelurahan/desa by kecamatan code
     */
    public function kelurahan(Request $request)
    {
        $kecamatanKode = $request->query('kec');
        
        if (!$kecamatanKode) {
            return response()->json(['error' => 'Kode kecamatan diperlukan'], 400);
        }

        $cacheKey = "wilayah_kelurahan_{$kecamatanKode}";
        
        $data = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($kecamatanKode) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/villages/{$kecamatanKode}.json");
            
            if ($response->successful()) {
                return $this->transformResponse($response->json());
            }
            
            return [];
        });

        return response()->json($data);
    }
}
