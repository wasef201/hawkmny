<div >
    <div style="display: inline; position: absolute; top: 0px; left:8px;width: 100px;">
        <x-form.input class="h-5" type="number" min="5" col="col-12 " wire:model.debounce.1000='rows' placeholder='عدد' />
    </div>
    <div class="row ">

        <div class="col-md-3">
            <x-form.input col="col-12 " wire:model='search' label="بحث" placeholder='البريد او رقم الترخيص' />
        </div>
        <div class="col-md-3">
            <x-form.input col="col-12 " wire:model='associationName' label="اسم الجمعية" placeholder='اسم الجمعية' />
        </div>
        <div class="col-md-3" wire:ignore>
            <x-form.select select2="" col="col-12" id='area' wire:model='area' name="area" label="المنطقة" required>
                <option value="all"> جميع المناطق </option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </x-form.select>
        </div>
        <div class="col-md-3" wire:ignore >
            <x-form.select select2="" id='city' col="col-12" wire:model='city' name="city" label="المدينه" required>
                <option value="all"> جميع المدن </option>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </x-form.select>
        </div>
        <div class="col-md-3" wire:ignore>
            <x-form.select select2="" col="col-12" id='section' wire:model='section' name='section' label="التخصص" required>
                <option value="all"> جميع التخصصات </option>
                @foreach($sections as $section => $label)
                <option value="{{ $section }}"> {{ $label }} </option>
                @endforeach
            </x-form.select>
        </div>
        <div class="col-md-3">
            <x-form.input col="col-12 " type="date" wire:model='createdFrom' label="التسجيل من تاريخ" placeholder='التسجيل من تاريخ' />
        </div>
        <div class="col-md-3">
            <x-form.input col="col-12 " type="date" wire:model='createdTo' label="التسجيل الي تاريخ" placeholder='التسجيل الي تاريخ' />
        </div>
    </div>

    <x-table :hide-action="!$canCreateOrEditOrDelete">
        <x-slot name="head">
            <th class="px-2 text-start">الجمعية</th>
            <th>التخصص</th>
            <th>المنطقة</th>
            <th>المدينة</th>
            <th>رقم الترخيص</th>
            <th>تاريخ الاتسجيل</th>
        </x-slot>
        <x-slot name="body">
            @foreach($associations as $association)
            <tr>
                <td class="d-flex align-items-center">
                    <!--begin:: Avatar -->
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="{{ route('association.show' ,  $association) }}">
                            @if ($association->logo)
                            <img  width="50" height="50" src="{{ $association->logoUrl() }}" alt="">
                            @else
                            <div class="symbol-label fs-3 bg-light-success text-success">{{ mb_substr($association->name, 0, 1, 'utf8') }}</div>
                            @endif
                        </a>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <a href="{{ route('association.show' , $association->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $association->name }}</a>
                        <a class="text-muted"><i class="bi-mailbox2"></i> {{ $association->email }}</a>
                        <a class="text-muted"><i class="bi-telephone-plus"></i>{{ $association->phone }}</a>
                    </div>
                    <!--begin::User details-->
                </td>
                <td class="text-center">{{ $association->section_text }}</td>
                <td class="text-center">{{ optional($association->area)->name ?? '- - -'}}</td>
                <td class="text-center">{{ optional($association->city)->name ?? '- - -'}}</td>
                <td class="text-center">{{ $association->number }}</td>
                <td class="text-center">{{ $association->created_at->toDateString() }}</td>

                <td style="white-space: nowrap; text-align: center">
                    @if($canCreateOrEditOrDelete)
                    <x-button.link href="{{ route('association.edit', $association) }}" class="btn-info btn-sm">تعديل</x-button.link>
                    <x-button.delete href="{{ route('association.destroy', $association) }}" class="btn-danger btn-sm">حذف</x-button.delete>
                    @endif
                    @if (!$association->isApproved())
                        <x-button.link href="{{ route('association.approve', $association ) }}" class="btn-primary btn-sm"> موافقه </x-button.link>
                    @endif
                </td>


            </tr>
            @endforeach
        </x-slot>
    </x-table>

    {{ $associations->links() }}
</div>

@push('script')
<script>

    $(document).ready(function () {
        $('#area').on('change', function (e) {
            var data = $('#area').select2("val");
            @this.set('area', data);
        });
        $('#city').on('change', function (e) {
            var data = $('#city').select2("val");
            @this.set('city', data);
        });
        $('#section').on('change', function (e) {
            var data = $('#section').select2("val");
            @this.set('section', data);
        });
    });


    $("#associations-wrap").hide()
    const areaId = $('#area').find(':selected').attr('value');
    if(areaId) {
        loadCities(areaId);
    }
    $("#area").on('select2:select', function (e) {
        loadCities(e.params.data.id)
    });
    function loadCities(id) {
        fetch("{{ route('api.cities' ) }}", {
            method: "post",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({area_id: id})
        }).then(response => response.json())
        .then(response => {
            let data = $.map(response.data, function (obj) {
                            obj.text = obj.name; // replace pk with your identifier
                            return obj;
                        });
            $("#city").html('').select2({data});
        }).catch((error) => {
            console.error('Error:', error);
        });
    }

</script>
@endpush
