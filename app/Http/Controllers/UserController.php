<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $projectId = 'attendify-f8194';
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents";
    }

    public function index()
    {
        $response = Http::get("{$this->baseUrl}/users");
        $documents = $response['documents'] ?? [];

        $users = collect($documents)->filter(function ($doc) {
            return isset($doc['fields']['nama'], $doc['fields']['umur']);
        })->map(function ($doc) {
            $fields = $doc['fields'];
            $id = basename($doc['name']);
            return [
                'id' => basename($doc['name']), 
                'nama' => $fields['nama']['stringValue'] ?? '',
                'umur' => $fields['umur']['integerValue'] ?? '',
                'email' => $fields['email']['stringValue'] ?? '',
                'position' => $fields['position']['stringValue'] ?? '',
            ];
        });
        

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
{
    $counterUrl = "{$this->baseUrl}/counters/users";
    $counterResponse = Http::get($counterUrl);
    $lastId = $counterResponse['fields']['last_id']['integerValue'] ?? 0;
    $nextId = (int)$lastId + 1;
    $formattedId = 'E' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

    $userUrl = "{$this->baseUrl}/users/{$formattedId}";
    $storeUserResponse = Http::patch($userUrl, [
        "fields" => [
            "nama" => ["stringValue" => $request->input('nama')],
            "email" => ["stringValue" => $request->input('email')],
            "password" => ["stringValue" => bcrypt($request->input('password'))],
            "role" => ["stringValue" => $request->input('role')],
            "position" => ["stringValue" => $request->input('position')],
            "status" => ["stringValue" => $request->input('status')],
            "umur" => ["integerValue" => (int)$request->input('umur')],
        ]
    ]);

    // ✅ Update counter setelah user berhasil disimpan
    $updateCounterResponse = Http::patch($counterUrl, [
        "fields" => [
            "last_id" => ["integerValue" => $nextId]
        ]
    ]);

    return redirect()->route('users.index')->with('success', 'User created!');
}


    public function edit($id)
    {
        $response = Http::get("{$this->baseUrl}/users/{$id}");
        $fields = $response['fields'] ?? [];

        $user = [
            'id' => $id,
            'nama' => $fields['nama']['stringValue'] ?? '',
            'email' => $fields['email']['stringValue'] ?? '',
            'role' => $fields['role']['stringValue'] ?? '',
            'status' => $fields['status']['stringValue'] ?? '',
            'umur' => $fields['umur']['integerValue'] ?? '',
        ];
        

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $userUrl = "{$this->baseUrl}/users/{$id}";

        $updateData = [
            "nama" => ["stringValue" => $request->input('nama')],
            "email" => ["stringValue" => $request->input('email')],
            "role" => ["stringValue" => $request->input('role')],
            "position" => ["stringValue" => $request->input('position')],
            "status" => ["stringValue" => $request->input('status')],
            "umur" => ["integerValue" => (int)$request->input('umur')],
        ];
        
        if ($request->filled('password')) {
            $updateData['password'] = ["stringValue" => bcrypt($request->input('password'))];
        }
        
        Http::patch($userUrl, [
            "fields" => $updateData
        ]);
        

        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    public function destroy($id)
    {
        $userUrl = "{$this->baseUrl}/users/{$id}";
        Http::delete($userUrl);

        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
