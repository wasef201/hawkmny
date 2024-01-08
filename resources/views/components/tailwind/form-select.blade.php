<div class="mt-4 bg-[#F7F7F7] rounded-xl p-2 focus:border-color_2  focus-visible:border-color_2 border-gray-300">
    <label class="block">
        <x-tailwind.form-label :label="$label"/>
        @if(!($wireModifier??''))
            @php
                $selected=old($name);
            @endphp
        @endif
        <select
            wire:model{!! $wireModifier??'' !!}="{{ $name }}"

            name="{{ $name }}"
            id="{{ $name }}"

            @if($multiple??false)
                multiple
            @endif

            @if($placeholder??'')
                placeholder="{{ $placeholder }}"
            @endif

            {!! $attributes->merge([
                'class' => ($label ? 'mt-1 ' : '') . 'block w-full mt-1 bg-[#F7F7F7] rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
            ]) !!}>

            @if($placeholder??'')
                <option value="" class="text-gray-900" @if($nothingSelected) selected="selected" @endif>
                    {{ $placeholder }}
                </option>
            @endif

            @forelse($options as $key => $option)
                <option value="{{ $key }}" @if(($key==($selected??''))) selected="selected" @endif>
                    {{ $option }}
                </option>
            @empty
                {!! $slot !!}
            @endforelse
        </select>
    </label>

    @if($errors->has($name))
        <x-tailwind.form-errors :name="$name"/>
    @endif
</div>
@once
    @push('script')
        <script>
            function handelSelect2Data(data) {
                return $.map([{id: 0, name: '-- الكل --'}, ...data], function (obj) {
                    obj.text = obj.name;
                    return obj;
                })
            }
        </script>
    @endpush
@endonce
@if($attributes->has('select2'))
    @push('scripts')
        <script>
            $(function () {

                $('#{{ $id ?? $name }}').select2().on('change', function (e) {
                    let data = e.target.value;
                    @if($attributes->has('multiple'))
                        data = $('#{{ $id ?? $name }}').select2('data').map((item) => item.id);
                    @endif
                    @if($attributes->has('wire:model'))
                    @this.
                    set('{{ $name }}', data);
                    @endif
                });

            })
        </script>
    @endpush
@endif
