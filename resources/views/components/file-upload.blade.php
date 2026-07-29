@props(['id' => uniqid('file_'), 'label' => 'Choose a file'])
<div class="file-upload-wrapper border border-dashed rounded p-4 text-center vt-bg-surface vt-border" {!! $attributes !!}>
    <i data-lucide="upload-cloud" class="text-secondary mb-2" style="width: 32px; height: 32px;"></i>
    <p class="mb-2 vt-body-small text-secondary">{{ $label }}</p>
    <input type="file" id="{{ $id }}" class="d-none" {{ $attributes->except('class') }}>
    <label for="{{ $id }}" class="btn vt-btn btn-outline-secondary btn-sm">Browse Files</label>
</div>