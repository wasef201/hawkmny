<x-panel  title="{{ $standard->name }} - {{ $practices->count() }} ممارسة"
          create-label="اضافة ممارسة"
          href="{{ route('standard.practice.create', $standard) }}">
    <x-table>
        <x-slot name="head">
            <th class="px-2 text-start">الممارسة</th>
            <th>المجال</th>
            <th>الدرجة</th>
            <th>الاسئلة</th>
            <th>اخر تعديل</th>
        </x-slot>
        <x-slot name="body">
            @foreach($practices as $practice)
                <tr>
                    <td>{{ $practice->name }}</td>
                    <td class="text-center">{{ optional($practice->field)->name ?? '- - -'}}</td>
                    <td class="text-center">{{ $practice->degree }}</td>
                    <td class="text-center">{{ $practice->questions_count }}</td>
                    <td class="text-center">{{ $practice->updated_at->toDateString() }}</td>
                    <td style="white-space: nowrap; text-align: center">
                        <x-button.link href="{{ route('practice.edit', $practice) }}" class="btn-info btn-sm">تعديل</x-button.link>
                        <x-button.delete href="{{ route('practice.destroy', $practice) }}" class="btn-danger btn-sm">حذف</x-button.delete>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</x-panel>
