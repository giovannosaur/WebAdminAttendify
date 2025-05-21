@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="section-title">Admin Panel</div>
  <div class="grid">
    <a href="{{ url('/employee-management') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">👥</div>
        <div class="label">Employee Management</div>
      </div>
    </a>
    <a href="{{ url('/attendance') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">📅</div>
        <div class="label">Attendance Logs</div>
      </div>
    </a>
    <a href="{{ url('/leave-requests') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">📝</div>
        <div class="label">Leave Requests</div>
      </div>
    </a>
    <a href="{{ url('/payroll') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">💰</div>
        <div class="label">Payroll</div>
      </div>
    </a>
    <a href="{{ url('/overtime') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">⏱️</div>
        <div class="label">Overtime</div>
      </div>
    </a>
    <a href="{{ url('/feedback') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">💬</div>
        <div class="label">Feedback</div>
      </div>
    </a>
    <a href="{{ url('/roles') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">💬</div>
        <div class="label">Roles</div>
      </div>
    </a>
    <a href="{{ url('/schedule') }}" style="text-decoration: none; color: inherit;">
      <div class="card">
        <div class="icon">💬</div>
        <div class="label">Schedule</div>
      </div>
    </a>
  </div>
@endsection
