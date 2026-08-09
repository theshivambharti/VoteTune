@extends('layouts.guest')
@section('title', 'Terms of Service - VoteTune')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card class="shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h1 class="vt-h2 mb-4 text-primary">Terms of Service</h1>
                    <p class="text-muted mb-4">Last updated: {{ date('F j, Y') }}</p>
                    
                    <h4 class="vt-h5 mt-4">1. Acceptance of Terms</h4>
                    <p>By accessing or using VoteTune, you agree to be bound by these Terms of Service.</p>
                    
                    <h4 class="vt-h5 mt-4">2. Description of Service</h4>
                    <p>VoteTune is a real-time voting and music queue management platform designed to help hosts and guests interact.</p>
                    
                    <h4 class="vt-h5 mt-4">3. User Conduct</h4>
                    <p>You agree not to use the Service for any unlawful purpose or in any way that interrupts, damages, or impairs the service.</p>
                    
                    <div class="mt-5 text-center">
                        <a href="{{ url('/') }}" class="btn vt-btn vt-btn-primary px-4">Return Home</a>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</div>
@endsection
