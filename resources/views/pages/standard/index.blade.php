<x-panel padding="p-0" class="bg-transparent pt-5" title="المعايير" create-label="اضافة معيار" create-route="standard.create">
    <div class="row g-6 g-xl-9 text-center">
        <div class="col-md-6 col-lg-3">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Heading-->
                    <div class="fs-4x fw-bolder">{{ $standards->count() }}</div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7">عدد المعايير</div>
                    <!--end::Heading-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6 col-lg-3">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Heading-->
                    <div class="fs-4x fw-bolder">{{ $standards->sum('fields_count') }}</div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7">عدد المجالات</div>
                    <!--end::Heading-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6 col-lg-3">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Heading-->
                    <div class="fs-4x fw-bolder">{{ $standards->sum('practices_count') }}</div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7">عدد الممارسات</div>
                    <!--end::Heading-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6 col-lg-3">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Heading-->
                    <div class="fs-4x fw-bolder">{{ $standards->sum('questions_count') }}</div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7">عدد الاسئلة</div>
                    <!--end::Heading-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <div class="row g-6 g-xl-9 text-center py-5">
        @foreach($standards as $standard)
            <div class="col-12 col-md-6">
                <x-card card-title="{{ $standard->name }}">
                    <x-slot name="cardActions">
                        <x-button.link class="btn-sm btn-secondary" href="{{ route('question.index', ['standard' => $standard->id]) }}">الاسئلة</x-button.link>
                        <x-button.link class="btn-sm btn-success" href="{{ route('standard.practice.index', $standard) }}">الممارسات</x-button.link>
                        <x-button.link class="btn-sm btn-primary" href="{{ route('standard.fields.create', $standard) }}">اضافة مجال</x-button.link>
                        
                    </x-slot>
                    <x-table>
                        <x-slot name="head">
                            <th>المجال</th>
                            <th>الدرجة</th>
                            <th>الممارسات</th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($standard->fields as $field)
                                <tr>
                                    <td class="fw-bold fs-4">{{ $field->name }}</td>
                                    <td>{{ $field->degree }}</td>
                                    <td>{{ $field->practices_count }}</td>
                                    <td>
                                        <x-button.edit-icon href="{{ route('fields.edit', $field) }}"/>
                                        <x-button.delete-icon href="{{ route('fields.destroy', $field) }}"/>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                </x-card>
            </div>
        @endforeach
    </div>
</x-panel>
