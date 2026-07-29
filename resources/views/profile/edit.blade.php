@extends('layouts.app')
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
