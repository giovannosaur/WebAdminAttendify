@extends('layouts.app')

@section('content')
<header>
    <h1>Edit Employee</h1>
</header>

<div class="form-container">
    <form action="{{ route('users.update', $user['id']) }}" method="POST">
        @csrf
        @method('PUT')
        @include('users.form')
        <div class="actions">
            <button type="submit" class="save-btn">Save Changes</button>
            <a href="{{ route('users.index') }}"><button type="button" class="cancel-btn">Cancel</button></a>
        </div>
    </form>
</div>
@endsection
