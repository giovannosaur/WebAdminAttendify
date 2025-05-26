@extends('layouts.app')

@section('content')
<header>
    <h1>Add Employee</h1>
</header>

<div class="form-container">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        @include('users.form')
        <div class="actions">
            <button type="submit" class="save-btn">Create</button>
            <a href="{{ route('users.index') }}"><button type="button" class="cancel-btn">Cancel</button></a>
        </div>
    </form>
</div>
@endsection
