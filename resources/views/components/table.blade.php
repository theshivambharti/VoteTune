@props(['responsive' => true])
<div class="{{ $responsive ? 'table-responsive' : '' }}">
    <table {{ $attributes->merge(['class' => 'table align-middle']) }}>
        @if(isset($thead))
            <thead>
                {{ $thead }}
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
        @if(isset($tfoot))
            <tfoot>
                {{ $tfoot }}
            </tfoot>
        @endif
    </table>
</div>