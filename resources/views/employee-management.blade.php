@php
    dump($employees ?? 'EMPLOYEES TIDAK DISET');
@endphp


@extends('layout')

@section('content')
<div class="container">
    <h1>Employee Management</h1>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="position" placeholder="Position" required>
        <select name="status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <button type="submit">Add Employee</button>
    </form>

    <hr>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Position</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $emp)
            <tr>
                <td>{{ $emp['id'] }}</td>
                <td>{{ $emp['name'] }}</td>
                <td>{{ $emp['email'] }}</td>
                <td>{{ $emp['position'] }}</td>
                <td>{{ $emp['status'] }}</td>
                <td>
                    <a href="{{ route('employees.edit', $emp['id']) }}">Edit</a>
                    <form action="{{ route('employees.destroy', $emp['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
