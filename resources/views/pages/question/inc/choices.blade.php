<div class="form-group">
    <x-form.input.label id="choices" required label="الاختيارات"/>
    <x-table>
        <x-slot name="head">
            <th>الاختيار</th>
            <th>النسبة</th>
        </x-slot>
        <x-slot name="body">
            @foreach($choices as $choice)
                <tr wire:key="{{ $choice->id }}">
                    <td>
                        <x-form.input wire:model="choices.{{ $loop->index }}.name" name="choice[{{ $choice->id }}][name]" value="{{ $choice->name }}"/>
                    </td>
                    <td>
                        <x-form.input type="number" step="0.1" wire:model="choices.{{ $loop->index }}.percentage" name="choice[{{ $choice->id }}][percentage]" value="{{ $choice->percentage }}"/>
                    </td>
                    <td>
                        <x-button type="button" class="btn-sm" color="info" wire:click="update({{ $choice->id }})">حفظ</x-button>
                        <x-button.delete event="delete" :data="$choice->id" class="btn btn-danger" href="#!">حذف</x-button.delete>
                    </td>
                </tr>
            @endforeach
                <tr>
                    <td>
                        <x-form.input wire:model.defer="title" name="title"/>
                    </td>
                    <td>
                        <x-form.input type="number" step="0.1" wire:model.defer="percentage" name="percentage"/>
                    </td>
                    <td>
                        <x-button type="button" class="btn-sm" wire:click="create">اضافة</x-button>
                    </td>
                </tr>
        </x-slot>
    </x-table>
</div>
