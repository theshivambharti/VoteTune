@props(['count' => 0])
@if($count > 0)
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" {!! $attributes !!}>
        {{ $count > 99 ? '99+' : $count }}
        <span class="visually-hidden">unread messages</span>
    </span>
@endif