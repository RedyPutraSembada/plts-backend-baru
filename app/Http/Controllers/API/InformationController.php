<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function all(Request $request){
        $informations = Informasi::all();
        $host = request()->getSchemeAndHttpHost();
        // $host = request()->getHttpHost();
        // ddd($informations);

        foreach ($informations as $information) {
            $res [] = [
                'id_informasi' => $information->id,
                'title' => $information->title,
                'gambar' => $host.'/storage/'.$information->gambar,
                'deskripsi' => $information->deskripsi,
                'created_at' => $information->created_at,
                'updated_at' => $information->updated_at
            ];
        }

        if($informations->isEmpty())
            return ResponseFormatter::error('No data available in information', 'Information data not found', 404);
        else
            return ResponseFormatter::success($res, 'You have successfully getting information data', 200);
    }
}
