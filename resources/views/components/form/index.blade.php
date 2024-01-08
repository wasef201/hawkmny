<form method="POST" {{ $attributes->class(['form']) }}>
@csrf
    @isset($method)
    @method($method)
    @endisset
    {{ $slot }}
    @if(!isset($submitBtn))
        <x-button type="submit">{{ $submitText ?? 'حفظ' }}</x-button>
    @endif
    {{ $submitBtn ?? null }}
</form>
