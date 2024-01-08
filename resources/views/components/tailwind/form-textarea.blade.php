<div class="bg-[#F7F7F7] rounded-xl p-2 focus:border-color_2  focus-visible:border-color_2 border-gray-300 mt-2">
    <label class="block">
        <x-tailwind.form-label :label="$label" />

        <textarea
                wire:model{!! $wireModifier !!}="{{ $name }}"
            name="{{ $name }}"

            {!! $attributes->merge(['class' => 'bg-[#F7F7F7] block w-full rounded-md  shadow-sm focus:border-color_2  focus-visible:border-color_2 focus:ring focus:ring-color_2 focus:ring-opacity-50' . ($label ? ' mt-1' : '')]) !!}
        ></textarea>
    </label>

    @if($errors->has($name))
        <x-tailwind.form-errors :name="$name" />
    @endif
</div>
