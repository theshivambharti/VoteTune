@extends('layouts.app')
@section('title', 'Dashboard - VoteTune')
@section('header', 'Dashboard')
@section('content')
<x-card>
    <div class="card-body">
        <h5 class="vt-h5">Welcome, {{ auth()->user()->name }}</h5>
        <p class="vt-body-medium text-muted">You are logged in as a standard User.</p>
    </div>
</x-card>
@endsection
