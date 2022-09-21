<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\MasterStatus;
use Illuminate\Http\Request;
use Auth;

class TagihanController extends Controller
{
    public function all(Request $request)
    {
        // Request Parameter
        $year = $request->date('year');
        $kios = $request->input('kios');

        // Year Parameter
        if ($year) {
            $tagihan = Tagihan::with('SewaKios', 'MasterStatus')
                ->where('user_id', Auth::user()->User->id)
                ->whereYear('periode', $year)
                ->get();

            foreach ($tagihan as $dataTagihan) {
                if ($dataTagihan->diskon != 0) {
                    $totalTagihan = $dataTagihan->tagihan_kios - ($dataTagihan->diskon / 100 * $dataTagihan->tagihan_kios) + $dataTagihan->tagihan_kwh;
                } else {
                    $totalTagihan = $dataTagihan->tagihan_kwh + $dataTagihan->tagihan_kios;
                }
                $response[] = [
                    'id_sewa' => $dataTagihan->SewaKios->id,
                    'id_tagihan' => $dataTagihan->id,
                    'kode_tagihan' => $dataTagihan->kode_tagihan,
                    'nama_lengkap' => $dataTagihan->User->nama_lengkap,
                    'account_number' => $dataTagihan->User->rekening,
                    'nama_kios' => $dataTagihan->SewaKios->RelasiKios->Kios->nama_kios,
                    'lokasi_kios' => $dataTagihan->SewaKios->RelasiKios->Lokasi->nama_lokasi,
                    'periode' => date('m-Y', strtotime($dataTagihan->periode)),
                    'tagihan_kios' => $dataTagihan->tagihan_kios,
                    'kwh' => $dataTagihan->total_kwh,
                    'tagihan_kwh' => $dataTagihan->tagihan_kwh,
                    'total_tagihan' => $totalTagihan,
                    'status_bayar' => [
                        'id' => $dataTagihan->MasterStatus->id,
                        'name' => $dataTagihan->MasterStatus->nama_status,
                    ]
                ];
            };

            if ($tagihan->isEmpty())
                return ResponseFormatter::error('No data available in bill', 'Bill not found', 404);
            else
                return ResponseFormatter::success($response, 'You have successfully getting bill data by year params');

            // Kios Parameter
        } else if ($kios) {
            $tagihan = Tagihan::with('SewaKios', 'MasterStatus')
                ->where([
                    'user_id' => Auth::user()->User->id,
                    'sewa_kios_id' => $kios
                ])->get();

            foreach ($tagihan as $dataTagihan) {
                if ($dataTagihan->diskon != 0) {
                    $totalTagihan = $dataTagihan->tagihan_kios - ($dataTagihan->diskon / 100 * $dataTagihan->tagihan_kios) + $dataTagihan->tagihan_kwh;
                } else {
                    $totalTagihan = $dataTagihan->tagihan_kwh + $dataTagihan->tagihan_kios;
                }
                $response[] = [
                    'id_sewa' => $dataTagihan->SewaKios->id,
                    'id_tagihan' => $dataTagihan->id,
                    'kode_tagihan' => $dataTagihan->kode_tagihan,
                    'nama_lengkap' => $dataTagihan->User->nama_lengkap,
                    'account_number' => $dataTagihan->User->rekening,
                    'nama_kios' => $dataTagihan->SewaKios->RelasiKios->Kios->nama_kios,
                    'lokasi_kios' => $dataTagihan->SewaKios->RelasiKios->Lokasi->nama_lokasi,
                    'periode' => date('m-Y', strtotime($dataTagihan->periode)),
                    'tagihan_kios' => $dataTagihan->tagihan_kios,
                    'kwh' => $dataTagihan->total_kwh,
                    'tagihan_kwh' => $dataTagihan->tagihan_kwh,
                    'total_tagihan' => $totalTagihan,
                    'status_bayar' => [
                        'id' => $dataTagihan->MasterStatus->id,
                        'name' => $dataTagihan->MasterStatus->nama_status,
                    ]
                ];
            };

            if ($tagihan->isEmpty())
                return ResponseFormatter::error('No data available in bill', 'Bill not found', 404);
            else
                return ResponseFormatter::success($response, 'You have successfully getting bill data by kios params');

            // Kios & Tahun Parameter
        } else if ($year & $kios) {
            $tagihan = Tagihan::with('SewaKios', 'MasterStatus')
                ->where([
                    'user_id' => Auth::user()->User->id,
                    'sewa_kios_id' => $kios
                ])
                ->whereYear('periode', $year)
                ->get();

            foreach ($tagihan as $dataTagihan) {
                if ($dataTagihan->diskon != 0) {
                    $totalTagihan = $dataTagihan->tagihan_kios - ($dataTagihan->diskon / 100 * $dataTagihan->tagihan_kios) + $dataTagihan->tagihan_kwh;
                } else {
                    $totalTagihan = $dataTagihan->tagihan_kwh + $dataTagihan->tagihan_kios;
                }
                $response[] = [
                    'id_sewa' => $dataTagihan->SewaKios->id,
                    'id_tagihan' => $dataTagihan->id,
                    'kode_tagihan' => $dataTagihan->kode_tagihan,
                    'nama_lengkap' => $dataTagihan->User->nama_lengkap,
                    'account_number' => $dataTagihan->User->rekening,
                    'nama_kios' => $dataTagihan->SewaKios->RelasiKios->Kios->nama_kios,
                    'lokasi_kios' => $dataTagihan->SewaKios->RelasiKios->Lokasi->nama_lokasi,
                    'periode' => date('m-Y', strtotime($dataTagihan->periode)),
                    'tagihan_kios' => $dataTagihan->tagihan_kios,
                    'kwh' => $dataTagihan->total_kwh,
                    'tagihan_kwh' => $dataTagihan->tagihan_kwh,
                    'total_tagihan' => $totalTagihan,
                    'status_bayar' => [
                        'id' => $dataTagihan->MasterStatus->id,
                        'name' => $dataTagihan->MasterStatus->nama_status,
                    ]
                ];
            };

            if ($tagihan->isEmpty())
                return ResponseFormatter::error('No data available in bill', 'Bill not found', 404);
            else
                return ResponseFormatter::success($response, 'You have successfully getting bill data by kios & year params');

            // No Parameter
        } else {
            $tagihan = Tagihan::with('SewaKios', 'MasterStatus')
                ->where('user_id', Auth::user()->User->id)
                ->get();

            foreach ($tagihan as $dataTagihan) {
                if ($dataTagihan->diskon != 0) {
                    $totalTagihan = $dataTagihan->tagihan_kios - ($dataTagihan->diskon / 100 * $dataTagihan->tagihan_kios) + $dataTagihan->tagihan_kwh;
                } else {
                    $totalTagihan = $dataTagihan->tagihan_kwh + $dataTagihan->tagihan_kios;
                }
                $response[] = [
                    'id_sewa' => $dataTagihan->SewaKios->id,
                    'id_tagihan' => $dataTagihan->id,
                    'kode_tagihan' => $dataTagihan->kode_tagihan,
                    'nama_lengkap' => $dataTagihan->User->nama_lengkap,
                    'account_number' => $dataTagihan->User->rekening,
                    'nama_kios' => $dataTagihan->SewaKios->RelasiKios->Kios->nama_kios,
                    'lokasi_kios' => $dataTagihan->SewaKios->RelasiKios->Lokasi->nama_lokasi,
                    'periode' => date('m-Y', strtotime($dataTagihan->periode)),
                    'tagihan_kios' => $dataTagihan->tagihan_kios,
                    'kwh' => $dataTagihan->total_kwh,
                    'tagihan_kwh' => $dataTagihan->tagihan_kwh,
                    'total_tagihan' => $totalTagihan,
                    'status_bayar' => [
                        'id' => $dataTagihan->MasterStatus->id,
                        'name' => $dataTagihan->MasterStatus->nama_status,
                    ]
                ];
            };

            if ($tagihan->isEmpty())
                return ResponseFormatter::error('No data available in bill', 'Bill not found', 404);
            else
                return ResponseFormatter::success($response, 'You have successfully getting all bill data');
        }
    }
}
