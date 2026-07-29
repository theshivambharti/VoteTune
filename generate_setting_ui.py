import os

content = r"""@extends('layouts.app')

@section('title', 'Website Settings')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">System Configuration</h1>
            <p class="text-muted mb-0">Manage your application settings and configurations.</p>
        </div>
        <div>
            <span class="badge bg-primary px-3 py-2">
                <i data-lucide="info" class="me-1" style="width: 14px; height: 14px;"></i>
                Laravel v{{ app()->version() }} | PHP v{{ phpversion() }}
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 mb-4">
            <x-card class="position-sticky" style="top: 20px;">
                <div class="p-3 border-bottom">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        </span>
                        <input type="text" id="settingSearch" class="form-control border-start-0 ps-0" placeholder="Search settings...">
                    </div>
                </div>
                <div class="nav flex-column nav-pills p-2" id="settings-tab" role="tablist" aria-orientation="vertical">
                    @foreach($groupedSettings as $group => $settings)
                        <button class="nav-link text-start rounded-3 mb-1 {{ $loop->first ? 'active' : '' }}" 
                                id="tab-{{ Str::slug($group) }}" 
                                data-bs-toggle="pill" 
                                data-bs-target="#content-{{ Str::slug($group) }}" 
                                type="button" 
                                role="tab">
                            <i data-lucide="settings-2" class="me-2" style="width: 16px; height: 16px;"></i>
                            {{ ucwords(str_replace('_', ' ', $group)) }}
                        </button>
                    @endforeach
                </div>
            </x-card>
        </div>

        <!-- Content Area -->
        <div class="col-md-9">
            <div class="tab-content" id="settings-tabContent">
                @foreach($groupedSettings as $group => $settings)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                         id="content-{{ Str::slug($group) }}" 
                         role="tabpanel" 
                         tabindex="0">
                        
                        <x-card>
                            <form action="{{ route('admin.settings.update', $group) }}" method="POST" enctype="multipart/form-data" class="settings-form">
                                @csrf
                                <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center py-3">
                                    <h5 class="mb-0">{{ ucwords(str_replace('_', ' ', $group)) }} Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-4">
                                        @foreach($settings as $setting)
                                            <div class="col-12 col-md-6 setting-item" data-search="{{ strtolower(str_replace('_', ' ', $setting->key)) }}">
                                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                                                
                                                @if($setting->type === 'boolean')
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" 
                                                               name="{{ $setting->key }}" 
                                                               id="{{ $setting->key }}" 
                                                               value="1"
                                                               {{ $setting->value == '1' || $setting->value == true ? 'checked' : '' }}>
                                                        <label class="form-check-label text-muted small" for="{{ $setting->key }}">Enable</label>
                                                    </div>
                                                    
                                                @elseif($setting->type === 'password')
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" 
                                                               name="{{ $setting->key }}" 
                                                               placeholder="{{ $setting->value ? '******** (Encrypted - Leave blank to keep)' : 'Enter value' }}">
                                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                                            <i data-lucide="eye" style="width: 16px; height: 16px;"></i>
                                                        </button>
                                                    </div>
                                                    
                                                @elseif($setting->type === 'file')
                                                    @if($setting->value)
                                                        <div class="mb-2">
                                                            <img src="{{ Storage::url($setting->value) }}" alt="Current" class="img-thumbnail" style="max-height: 80px;">
                                                        </div>
                                                    @endif
                                                    <input type="file" class="form-control" name="{{ $setting->key }}" accept="image/*">
                                                    
                                                @elseif($setting->type === 'integer')
                                                    <input type="number" class="form-control" 
                                                           name="{{ $setting->key }}" 
                                                           value="{{ $setting->value }}">
                                                    
                                                @else
                                                    <input type="text" class="form-control" 
                                                           name="{{ $setting->key }}" 
                                                           value="{{ $setting->value }}">
                                                @endif
                                                
                                                @if($setting->description)
                                                    <div class="form-text">{{ $setting->description }}</div>
                                                @endif
                                                @error($setting->key)
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="card-footer bg-light border-top sticky-bottom p-3 d-flex justify-content-between align-items-center" style="bottom: 0; z-index: 10;">
                                    <div>
                                        @if($group === 'smtp')
                                            <button type="button" class="btn btn-outline-info me-2" onclick="testSmtp()">
                                                <i data-lucide="send" class="me-1" style="width: 16px; height: 16px;"></i> Test SMTP
                                            </button>
                                        @endif
                                        <button type="reset" class="btn btn-light">Reset Defaults</button>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-save">
                                        <i data-lucide="save" class="me-1" style="width: 16px; height: 16px;"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </x-card>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Unsaved Changes Detection
        let formChanged = false;
        const forms = document.querySelectorAll('.settings-form');
        
        forms.forEach(form => {
            form.addEventListener('input', () => {
                formChanged = true;
                const saveBtn = form.querySelector('.btn-save');
                if(saveBtn) {
                    saveBtn.classList.remove('btn-primary');
                    saveBtn.classList.add('btn-success');
                    saveBtn.innerHTML = '<i data-lucide="save" class="me-1" style="width: 16px; height: 16px;"></i> Save Changes *';
                    lucide.createIcons();
                }
            });
            
            form.addEventListener('submit', () => {
                formChanged = false; // Reset on intentional submit
            });
        });

        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        // Toggle Password Visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.setAttribute('data-lucide', 'eye-off');
                } else {
                    input.type = 'password';
                    icon.setAttribute('data-lucide', 'eye');
                }
                lucide.createIcons();
            });
        });

        // Client-side Search
        const searchInput = document.getElementById('settingSearch');
        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const activePane = document.querySelector('.tab-pane.active');
            if(!activePane) return;
            
            const items = activePane.querySelectorAll('.setting-item');
            items.forEach(item => {
                const text = item.getAttribute('data-search');
                if (text.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Reset Search on Tab Change
        document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (event) {
                searchInput.value = '';
                document.querySelectorAll('.setting-item').forEach(item => item.style.display = '');
            });
        });
    });

    // Test SMTP Function
    function testSmtp() {
        Swal.fire({
            title: 'Test SMTP Settings',
            input: 'email',
            inputLabel: 'Enter your email address to receive a test email',
            inputPlaceholder: 'name@example.com',
            showCancelButton: true,
            confirmButtonText: 'Send Test',
            showLoaderOnConfirm: true,
            preConfirm: (email) => {
                // Collect current form data (in case they made changes before saving)
                const form = document.querySelector('#content-smtp form');
                const formData = new FormData(form);
                formData.append('test_email', email);
                
                return fetch('{{ route("admin.settings.test-smtp") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.message || 'Server error') });
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: result.value.message
                });
            }
        });
    }
</script>
@endpush
@endsection
"""

os.makedirs('resources/views/admin/settings', exist_ok=True)
with open('resources/views/admin/settings/index.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Settings view generated.")
