<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SewaKios;
use App\Models\RelasiKios;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class SewaKiosController extends Controller
{
    public function all(Request $request)
    {
        $kios = SewaKios::with('RelasiKios', 'Tagihan')->where('user_id', Auth::user()->User->id)->get();

        foreach ($kios as $dataKios) {
            $response[] = [
                'id_sewa' => $dataKios->id,
                'nama_kios' => $dataKios->RelasiKios->Kios->nama_kios,
                'tipe_kios' => $dataKios->RelasiKios->TarifKios->tipe,
                'tarif_kios' => $dataKios->RelasiKios->TarifKios->harga,
                'tempat_kios' => $dataKios->RelasiKios->Kios->tempat,
                'lokasi_kios' => $dataKios->RelasiKios->Lokasi->nama_lokasi,
                'tagihan_terakhir' => [
                    'total_tagihan' => $dataKios->Tagihan->tagihan_kios + $dataKios->Tagihan->tagihan_kwh,
                    'total_kwh' => $dataKios->Tagihan->total_kwh,
                    'date' => date('m-Y', strtotime($dataKios->Tagihan->periode)),
                    'status_tagihan' => $dataKios->Tagihan->MasterStatus->nama_status
                ]
            ];
        };

        if ($response)
            return ResponseFormatter::success($response, 'You have successfully getting sewa kios data');
        else
            return ResponseFormatter::error('No data available in sewa kios', 'sewa kios not found', 404);
    }
}
