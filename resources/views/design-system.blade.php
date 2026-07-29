@extends('layouts.app')

@section('content')
<x-page-header title="Design System" description="Living documentation of VoteTune's UI foundation." />

<div class="row g-4">
    <!-- Typography -->
    <div class="col-12">
        <x-card>
            <x-slot name="header">
                <h5 class="mb-0">Typography</h5>
            </x-slot>
            <div class="vt-display mb-3">Display Text</div>
            <div class="vt-h1 mb-3">Heading 1</div>
            <div class="vt-h2 mb-3">Heading 2</div>
            <div class="vt-h3 mb-3">Heading 3</div>
            <div class="vt-h4 mb-3">Heading 4</div>
            <p class="vt-body-large mb-3">Body Large - The quick brown fox jumps over the lazy dog.</p>
            <p class="vt-body mb-3">Body Default - The quick brown fox jumps over the lazy dog.</p>
            <p class="vt-body-small mb-3">Body Small - The quick brown fox jumps over the lazy dog.</p>
            <p class="vt-caption mb-0">Caption - The quick brown fox jumps over the lazy dog.</p>
        </x-card>
    </div>

    <!-- Colors -->
    <div class="col-12">
        <x-card>
            <x-slot name="header"><h5 class="mb-0">Colors</h5></x-slot>
            <div class="d-flex flex-wrap gap-3">
                <div class="p-4 rounded text-white bg-primary">Primary</div>
                <div class="p-4 rounded text-white bg-secondary">Secondary</div>
                <div class="p-4 rounded text-white bg-success">Success</div>
                <div class="p-4 rounded text-white bg-danger">Danger</div>
                <div class="p-4 rounded text-white bg-warning text-dark">Warning</div>
                <div class="p-4 rounded text-white bg-info text-dark">Info</div>
            </div>
        </x-card>
    </div>

    <!-- Buttons -->
    <div class="col-12 col-md-6">
        <x-card>
            <x-slot name="header"><h5 class="mb-0">Buttons</h5></x-slot>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <x-button class="vt-btn-primary">Primary</x-button>
                <x-button class="btn-secondary">Secondary</x-button>
                <x-button class="btn-outline-primary">Outline</x-button>
                <x-button class="btn-link">Link</x-button>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <x-button class="vt-btn-primary btn-sm">Small</x-button>
                <x-button class="vt-btn-primary btn-lg">Large</x-button>
                <x-button class="vt-btn-primary" disabled>Disabled</x-button>
            </div>
        </x-card>
    </div>

    <!-- Badges & Avatars -->
    <div class="col-12 col-md-6">
        <x-card>
            <x-slot name="header"><h5 class="mb-0">Badges & Avatars</h5></x-slot>
            <div class="d-flex gap-2 mb-4 align-items-center">
                <x-badge>Default</x-badge>
                <x-badge type="success">Success</x-badge>
                <x-badge type="danger">Danger</x-badge>
                <x-status-badge status="pending" />
            </div>
            <div class="d-flex gap-3 align-items-center">
                <x-avatar initials="JD" size="32px" />
                <x-avatar initials="JD" size="48px" />
                <x-avatar initials="JD" size="64px" />
            </div>
        </x-card>
    </div>

    <!-- Forms -->
    <div class="col-12 col-md-6">
        <x-card>
            <x-slot name="header"><h5 class="mb-0">Form Elements</h5></x-slot>
            <div class="mb-3">
                <label class="form-label vt-body-small">Text Input</label>
                <x-input placeholder="Enter text..." />
            </div>
            <div class="mb-3">
                <label class="form-label vt-body-small">Select</label>
                <x-select>
                    <option>Option 1</option>
                    <option>Option 2</option>
                </x-select>
            </div>
            <div class="mb-3 d-flex gap-4">
                <x-checkbox label="Checkbox" checked />
                <x-radio label="Radio" checked />
                <x-switch label="Switch" checked />
            </div>
        </x-card>
    </div>

    <!-- Alerts & Toasts -->
    <div class="col-12 col-md-6">
        <x-card>
            <x-slot name="header"><h5 class="mb-0">Alerts & Toasts</h5></x-slot>
            <x-alert type="primary" icon="info" class="mb-3" dismissible="true">This is a primary alert.</x-alert>
            <x-alert type="success" icon="check-circle" class="mb-3">Operation completed successfully.</x-alert>
            
            <div class="d-flex gap-2 mt-4">
                <x-button class="btn-outline-success btn-sm" onclick="App.toast.success('Success', 'Toast works!')">Show Success Toast</x-button>
                <x-button class="btn-outline-danger btn-sm" onclick="App.toast.error('Error', 'Toast works!')">Show Error Toast</x-button>
            </div>
        </x-card>
    </div>

    <!-- Modals & Misc -->
    <div class="col-12">
        <x-card>
            <x-slot name="header"><h5 class="mb-0">Modals & Empty States</h5></x-slot>
            <x-button class="btn-secondary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Open Modal</x-button>
            
            <div class="border rounded p-4">
                <x-empty-state title="No Data Found" description="Start by adding some new records." icon="inbox">
                    <x-button class="vt-btn-primary">Add Record</x-button>
                </x-empty-state>
            </div>
        </x-card>
    </div>
</div>

<x-modal id="exampleModal" title="Example Modal">
    <p>This is a reusable modal component in the design system.</p>
    <x-slot name="footer">
        <x-button class="btn-secondary" data-bs-dismiss="modal">Close</x-button>
        <x-button class="vt-btn-primary">Save Changes</x-button>
    </x-slot>
</x-modal>

@endsection