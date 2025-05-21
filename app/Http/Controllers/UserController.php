<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $projectId = 'attendify-f8194'; // ← Ganti ini
        $collection = 'users'; // ← Nama koleksi Firestore
        
        // 1. Ambil last_id
        $counterUrl = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/counters/users";
        $counterResponse = Http::get($counterUrl);
        $lastId = $counterResponse['fields']['last_id']['integerValue'] ?? 0;
        $nextId = (int)$lastId + 1;

        // 2. Format ID
        $formattedId = 'U' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        // 3. Simpan user
        $userUrl = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/users/{$formattedId}";
        Http::patch($userUrl, [
            "fields" => [
                "nama" => ["stringValue" => $request->input('nama')],
                "umur" => ["integerValue" => $request->input('umur')],
            ]
        ]);

        // 4. Update counter
        Http::patch($counterUrl, [
            "fields" => [
                "last_id" => ["integerValue" => $nextId]
            ]
        ]);

    }
}
