<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    protected $projectId = 'attendify-f8194';
    protected $collection = 'employees';
    protected $counterPath = 'counters/users';

    public function index()
    {
        $url = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/{$this->collection}?pageSize=1000";
        $response = Http::get($url);

        $employees = [];

        if (isset($response['documents'])) {
            foreach ($response['documents'] as $doc) {
                $fields = $doc['fields'];
                $id = basename($doc['name']); // ambil ID dokumen dari URL
                $employees[] = [
                    'id'       => $id,
                    'name'     => $fields['name']['stringValue'] ?? '',
                    'email'    => $fields['email']['stringValue'] ?? '',
                    'position' => $fields['position']['stringValue'] ?? '',
                    'status'   => $fields['status']['stringValue'] ?? '',
                ];
            }
        }

        return view('employee-management', compact('employees'));
    }

    public function store(Request $request)
    {
        $counterUrl = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/{$this->counterPath}";
        $counterResponse = Http::get($counterUrl);
        $lastId = $counterResponse['fields']['last_id']['integerValue'] ?? 0;
        $nextId = (int)$lastId + 1;
        $formattedId = 'U' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $employeeUrl = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/{$this->collection}/{$formattedId}";
        Http::patch($employeeUrl, [
            'fields' => [
                'name'     => ['stringValue' => $request->input('name')],
                'email'    => ['stringValue' => $request->input('email')],
                'position' => ['stringValue' => $request->input('position')],
                'status'   => ['stringValue' => $request->input('status') ?? 'Active'],
            ]
        ]);

        Http::patch($counterUrl, [
            'fields' => [
                'last_id' => ['integerValue' => $nextId]
            ]
        ]);

        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $url = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/{$this->collection}/{$id}";
        $response = Http::get($url);
        $fields = $response['fields'];

        $employee = [
            'id'       => $id,
            'name'     => $fields['name']['stringValue'] ?? '',
            'email'    => $fields['email']['stringValue'] ?? '',
            'position' => $fields['position']['stringValue'] ?? '',
            'status'   => $fields['status']['stringValue'] ?? '',
        ];

        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $url = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/{$this->collection}/{$id}";

        Http::patch($url, [
            'fields' => [
                'name'     => ['stringValue' => $request->input('name')],
                'email'    => ['stringValue' => $request->input('email')],
                'position' => ['stringValue' => $request->input('position')],
                'status'   => ['stringValue' => $request->input('status')],
            ]
        ]);

        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        $url = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/{$this->collection}/{$id}";
        Http::delete($url);

        return redirect()->route('employees.index');
    }
}
