<?php

namespace App\Http\Controllers\Api;

use App\Models\Notifikasi;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotifikasiResource;
use App\Http\Controllers\Api\NotifikasiController;

class NotifikasiController extends Controller
{
    public function index(){
        $notifikasi = Notifikasi::latest()->get();
        return response()->json([
            'data' => NotifikasiResource::collection($notifikasi),
            'message' => 'Berhasil',
            'success' => true,  
        ]);
        return view("user.lowongan",compact('notifikasi'));
    }
}
