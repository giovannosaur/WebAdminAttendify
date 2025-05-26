@extends('layouts.app')

@section('content')
<header style="background-color: #1976d2; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
    <div>
        <p style="margin: 0; font-size: 14px;">Admin Panel</p>
        <h1>Employee Management</h1>
    </div>
</header>

<main class="container">
    <a href="{{ route('users.create') }}">
        <button class="add-btn">+ Add Employee</button>
    </a>

    <div class="section-title">Employee List</div>
    <table class="employee-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user['id'] ?? 'N/A' }}</td> {{-- Tampilkan ID --}}
                <td>{{ $user['nama'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['position'] }}</td>
                <td class="actions">
                    <a href="{{ route('users.edit', $user['id']) }}"><button class="edit-btn">Edit</button></a>
                    <form action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
@endsection
