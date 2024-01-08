<div class="rounded-xl p-2 focus:border-color_2  focus-visible:border-color_2 border-gray-300 bg-[#F7F7F7] my-2 {{$display??''}}">
    <label class="flex items-center">
        <input
            {!! $attributes->merge(['class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50']) !!}
            type="checkbox"

            wire:model{!! $wireModifier??'' !!}="{{ $name }}"

            name="{{ $name }}"

            @if(old($name))
                checked="checked"
            @endif
        />

        <span class="mx-2">{{ $label }}</span>
    </label>

    @if($errors->has($name))
        <x-tailwind.form-errors :name="$name"/>
    @endif
</div>
