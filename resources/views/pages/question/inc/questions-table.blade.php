<div>
    @include('pages.question.inc.filters')
    <x-table>
        <x-slot name="head">
            <th class="px-2 text-start">السؤال</th>
            <th>المجال</th>
            <th>الممارسة</th>
            <th>الدرجة</th>
            <th>الاختيارات</th>
            <th>اخر تعديل</th>
        </x-slot>
        <x-slot name="body">
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->name }}</td>
                    <td class="text-center">{{ optional($question->field)->name ?? '- - -'}}</td>
                    <td class="text-center">{{ optional($question->practice)->name ?? '- - -'}}</td>
                    <td class="text-center">{{ $question->degree }}</td>
                    <td class="text-center">{{ $question->choices_count }}</td>
                    <td class="text-center" style="white-space: nowrap">{{ $question->updated_at->toDateString() }}</td>
                    <td style="white-space: nowrap; text-align: center">
                        <x-button.link href="{{ route('question.edit', $question) }}" class="btn-info btn-sm">تعديل</x-button.link>
                        <x-button.delete href="{{ route('question.destroy', $question) }}" class="btn-danger btn-sm">حذف</x-button.delete>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
    {{ $questions->links() }}
</div>

