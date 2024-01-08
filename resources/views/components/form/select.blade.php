<!--begin::Input group-->
<div class="my-2 {{ $col ?? null }}">
    <div class="form-group" wire:ignore>
        <!--begin::Label-->
        <x-form.input.label :label="$label??null" :id="$id ?? $name" :required="$attributes->has('required')"></x-form.input.label>
        <!--end::Label-->
        <select class="form-select @if($errors->count()){{ $errors->has($name) ? 'is-invalid' : 'is-valid'}} @endif " id="{{ $id ?? $name }}" name="{{ $name }}" @isset($select2) data-control="select2" @endisset
        data-placeholder="{{ $placeholder ?? '-- '.($label ?? $name).' --' }}" {{ $attributes }}>
            @isset($select2)<option></option>@endisset
            {{ $slot }}
        </select>
    </div>
    @once
    @push('script')
        <script>
            function handelSelect2Data(data) {
                return $.map([{id:0,name:'-- الكل --'},...data], function (obj) {
                    obj.text = obj.name;
                    return obj;
                })
            }
        </script>
    @endpush
    @endonce
    @if($attributes->has('select2'))
        @push('script')
            <script>
                    $('#{{ $id ?? $name }}').select2().on('change', function (e) {
                        let data = e.target.value;
                        @if($attributes->has('multiple'))
                            data = $('#{{ $id ?? $name }}').select2('data').map((item) => item.id);
                        @endif
                       @if($attributes->has('wire:model'))
                        @this.set('{{ $name }}', data);
                        @endif
                    });
            </script>
        @endpush
    @endif
</div>

