<div class="flex items-center justify-between">
    <button {!! $attributes->merge([
        'class' => 'btn',
        'type' => 'submit'
    ]) !!}>
        {!! trim($slot) ?: __('Submit') !!}
    </button>
</div>
