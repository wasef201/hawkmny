<x-table>
    <x-slot name="head">
        <th class="text-center"> رقم التقييم  </th>
        <th>  تاريخ البدىء  </th>
        <th>  اخر تحديث  </th>
        <th> نتيجه التقييم  </th>
        <th> نسبه الاكمال </th>
        <th> حاله التقييم </th>
    </x-slot>
    <x-slot name="body">
        @foreach ($association->reviews as $review)

            <tr>
                <td class="text-center">{{ $review->id }}</td>
                <td class="text-center">{{ $review->created_at->toDateString() }}</td>
                <td class="text-center">{{ $review->updated_at->toDateString() }}</td>
                <td class="text-center">{{ $review->degree }}</td>
                <td class="text-center">{{ $review->governance_meter() }} %  </td>
                <td class="text-success">
                    @switch($review->status)
                        @case(App\Models\Review::STARTED)
                        <span class="badge badge-primary " > تم بدىء التقييم </span>
                        @break
                        @case(App\Models\Review::PAUSED)
                        <span class="badge badge-light" > تم ايقاف التقييم </span>
                        @break
                        @case(App\Models\Review::IN_PROGRESS)
                        <span class="badge badge-warning" > جارى التقييم </span>
                        @break
                        @case(App\Models\Review::CANCELED)
                        <span class="badge badge-danger" > تم الغاء التقييم </span>
                        @break
                        @case(App\Models\Review::COMPLETED)
                        <span class='badge badge-success' > تم  اكمال التقييم </span>
                        @break
                    @endswitch
                </td>
                <td class="text-center">
                    <a href="{{ route('reviews.show' , ['review' => $review->id ] ) }}" class="btn btn-sm btn-primary me-2">
                        استعراض
                    </a>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-table>
