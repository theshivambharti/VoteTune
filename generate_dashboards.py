import os

views = {
    'resources/views/admin/dashboard.blade.php': r"""@extends('layouts.admin')
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
""",
    'resources/views/host/dashboard.blade.php': r"""@extends('layouts.host')
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
""",
    'resources/views/user/dashboard.blade.php': r"""@extends('layouts.app')
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
""",
    'resources/views/profile/edit.blade.php': r"""@extends('layouts.app')
@section('title', 'Profile - VoteTune')
@section('header', 'Profile Settings')
@section('content')
<div class="row g-4">
    <div class="col-12 col-lg-8">
        <x-card>
            <div class="card-body p-4">
                <h5 class="vt-h5 mb-4">Profile Information</h5>
                <x-flash-message />
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <x-input type="text" name="name" id="name" label="Full Name" value="{{ old('name', $user->name) }}" required />
                    </div>
                    
                    <div class="mb-3">
                        <x-input type="text" name="display_name" id="display_name" label="Display Name" value="{{ old('display_name', $user->display_name) }}" />
                    </div>
                    
                    <div class="mb-4">
                        <x-input type="email" name="email" id="email" label="Email Address" value="{{ old('email', $user->email) }}" required />
                    </div>
                    
                    <x-button type="submit" variant="primary">Save Changes</x-button>
                </form>
            </div>
        </x-card>
    </div>
</div>
@endsection
"""
}

os.makedirs('resources/views/admin', exist_ok=True)
os.makedirs('resources/views/host', exist_ok=True)
os.makedirs('resources/views/user', exist_ok=True)
os.makedirs('resources/views/profile', exist_ok=True)

for path, content in views.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
        
print("Dashboard views generated.")
