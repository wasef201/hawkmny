<div class="row">
    <x-form.select col="col-12 col-md-4" select2 wire:model="standard" name="standard" label="المعيار">
        <option value="0">-- الكل --</option>
        @foreach($standards as $standard)
            <option value="{{ $standard->id }}">{{ $standard->name }}</option>
        @endforeach
    </x-form.select>
    <x-form.select col="col-12 col-md-4" select2 wire:model="field" name="field" label="المجال">
        <option value="0">-- الكل --</option>
        @foreach($fields as $field)
            <option value="{{ $field->id }}">{{ $field->name }}</option>
        @endforeach
    </x-form.select>
    <x-form.select col="col-12 col-md-4" select2 wire:model="practice" name="practice" label="الممارسة">
        <option value="0">-- الكل --</option>
        @foreach($practices as $practice)
            <option value="{{ $practice->id }}">{{ $practice->name }}</option>
        @endforeach
    </x-form.select>
    <x-form.input col="col-12 col-md-6" wire:model.debounce="search" name="search" label="بحث"/>
    <x-form.select col="col-12 col-md-3" wire:model="sortBy" name="sortBy" label="الترتيب">
        <option value="0">-- الكل --</option>
        @foreach($sorts as $sort=>$label)
            <option value="{{ $sort }}">{{ $label }}</option>
        @endforeach
    </x-form.select>
    <x-form.select col="col-12 col-md-3" wire:model="perPage" name="perPage" label="في كل صفحة">
        <option value="0">-- الكل --</option>
        @foreach($pages as $num)
            <option value="{{ $num }}">{{ $num }}</option>
        @endforeach
    </x-form.select>
</div>
@once
    @push('script')
        <script>
            Livewire.on('filter:select2:standard:update', (fields) => {
                $("#field").html('').select2({data: handelSelect2Data(fields)})
            });
            Livewire.on('filter:select2:field:update', (practices) => {
                $("#practice").html('').select2({data: handelSelect2Data(practices)})
            });
        </script>
    @endpush
@endonce
