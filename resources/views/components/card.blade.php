<div {{ $attributes->class('card h-100') }}>
    @if(isset($cardTitle) || isset($cardActions)) <div class="card-header">
       <div class="card-title fs-3 fw-bolder">{{ $cardTitle }}</div>
        <div class="card-toolbar">
            {{ $cardActions ?? null }}
        </div>
    </div>
    @endisset
    <div class="card-body {{ $padding ?? 'p-3' }}">
        {{ $slot }}
    </div>
</div>
