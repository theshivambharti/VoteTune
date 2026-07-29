@extends('layouts.host')
@section('title', 'Host Dashboard - VoteTune')
@section('header', 'Host Dashboard')
@section('content')
<x-card>
    <div class="card-body">
        <h5 class="vt-h5">Welcome, {{ auth()->user()->name }}</h5>
        <p class="vt-body-medium text-muted">You are logged in as a Host.</p>
    </div>
</x-card>
@endsection
