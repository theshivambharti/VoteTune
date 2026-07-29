@props(['query' => ''])
<x-empty-state icon="search" title="No results found" description="We couldn't find anything matching '{{ $query }}'. Try adjusting your search." {!! $attributes !!}>
    {{ $slot }}
</x-empty-state>