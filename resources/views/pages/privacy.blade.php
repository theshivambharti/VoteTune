@extends('layouts.guest')
@section('title', 'Privacy Policy - VoteTune')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card class="shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h1 class="vt-h2 mb-4 text-primary">Privacy Policy</h1>
                    <p class="text-muted mb-4">Last updated: {{ date('F j, Y') }}</p>
                    
                    <h4 class="vt-h5 mt-4">1. Information We Collect</h4>
                    <p>We only collect the information necessary to provide the service, such as account credentials and voting history.</p>
                    
                    <h4 class="vt-h5 mt-4">2. Use of Information</h4>
                    <p>Your information is used strictly to operate the VoteTune platform, secure your account, and manage real-time queues.</p>
                    
                    <h4 class="vt-h5 mt-4">3. Third-Party Services</h4>
                    <p>We integrate with third-party services like YouTube for video embedding. Please review their privacy policies as well.</p>
                    
                    <div class="mt-5 text-center">
                        <a href="{{ url('/') }}" class="btn vt-btn vt-btn-primary px-4">Return Home</a>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</div>
@endsection
