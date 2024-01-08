<x-panel padding="p-0" class="bg-transparent pt-5" title="تقيمات الجمعيه" >
    <div class="row">
        <div class="col-md-6 text-center py-5">
            <div class="col-12">
                <x-card card-title='السؤال' >

                    <x-table class='table-row-borderd' >


                        <x-slot name="body">
                            <tr>
                                <th> السؤال </th>
                                <td> {{ optional($answer->question)->name }} </td>
                            </tr>
                            <tr>
                                <th>  الاجابات المتاحه للسؤال </th>
                                <th>
                                    <form action="{{ route('answers.update'  , ['answer' => $answer->id ] ) }}"  method="POST" name="submitNewAnswer" >
                                        @csrf
                                        @foreach (optional($answer->question)->choices ?? [] as $choice)
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="choice_id" value="{{ $choice->id }}"
                                                {{ $choice->id == $answer->choice_id  ? 'checked="checked"' : '' }}
                                                >
                                                {{ $choice->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </form>

                                </th>
                            </tr>

                            <tr>
                                <th> اجابه الجمعيه </th>
                                <th> <span class='' > {{ optional($answer->choice)->name }} </span> </th>
                            </tr>
                            <tr>
                                <th> درجه الاجابه </th>
                                <th> <span class='badge bg-success pr-2' > {{ $answer->degree }}  </span> نقطه </th>
                            </tr>
                        </x-slot>
                    </x-table>
                </x-card>
            </div>
        </div>


</div>


@push('script')
    <script>
        $(function() {
            $('input[name="choice_id"]').on('change', function(event) {
                event.preventDefault();
               $('form[name="submitNewAnswer"]').submit();
            });
        });
    </script>
@endpush
</x-panel>
