@error($name)
    <p {!! $attributes->merge(['class' => 'm-0 p-0 mt-1 text-sm text-red-600']) !!}>
        {{ $message }}
    </p>
@enderror
