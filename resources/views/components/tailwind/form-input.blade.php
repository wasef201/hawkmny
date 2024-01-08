<div class="@if(isset($type) && $type === 'hidden') hidden @else mt-2 @endif {{$classes??' '}} bg-[#F7F7F7] rounded-xl p-2 focus:border-color_2  focus-visible:border-color_2 border-gray-300">
    <label class="block">
        <x-tailwind.form-label :label="$label" />

        <input {!! $attributes->merge([
            'class' => 'block w-full bg-[#F7F7F7] rounded-md  shadow-sm border  focus:ring focus:ring-indigo-200  focus-visible:border-color_2 focus:border-color_2 focus:ring-opacity-50 ' . ($label ? 'mt-1' : '')
        ]) !!}
            wire:model{!! $wireModifier??'' !!}="{{ $name }}"
               @if(!($wireModifier??''))
                   value="{{old($name)}}"
               @endif
            name="{{ $name }}"
            type="{{ isset($type)?$type:'text' }}" />
    </label>
    @isset($help)<div class="text-sm text-color_3">{{ $help }}</div>@endisset

    @if($errors->has($name))
        <x-tailwind.form-errors :name="$name" />
    @endif
</div>
