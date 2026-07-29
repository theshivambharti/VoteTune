@props(['value' => 0, 'color' => 'primary', 'height' => '8px'])
<div class="progress" style="height: {{ $height }};" {!! $attributes !!}>
    <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $value }}%;" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100"></div>
</div>