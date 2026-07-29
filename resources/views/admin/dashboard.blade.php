@extends('layouts.admin')
@section('title', 'Admin Dashboard - VoteTune')
@section('header', 'Admin Dashboard')
@section('content')
<x-card>
    <div class="card-body">
        <h5 class="vt-h5">Welcome, {{ auth()->user()->name }}</h5>
        <p class="vt-body-medium text-muted">You are logged in as an Administrator.</p>
    </div>
</x-card>
@endsection
