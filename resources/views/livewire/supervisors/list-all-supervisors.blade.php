<div>
    <div class="row">
        <div class="col-md-3">
            <x-form.input col="col-12 " wire:model='search' label="بحث" placeholder='البريد الالكتروني او رقم الجوال' />
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
            <x-form.select col="col-12" id='scope' wire:model='scope' name='scope'  label="المجال" required>
                @foreach ($scopes as $scope => $name )
                    <option value="{{ $scope }}"> {{ $name }} </option>
                @endforeach
            </x-form.select>
        </div>
       
    </div>

    <x-table>
        <x-slot name="head">
            <th class="px-2 text-start">المشرف</th>
            <th>التخصص</th>
            <th>العنوان</th>
            <th>نطاق الاشراف</th>
            <th>الجمعيات</th>
            <th>تاريخ الاتسجيل</th>
        </x-slot>
        <x-slot name="body">
            @foreach($supervisors as $supervisor)
            <tr>
                <td class="d-flex align-items-center">
                    <!--begin:: Avatar -->
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="#!">
                            <div class="symbol-label fs-3 bg-light-success text-success">{{ mb_substr($supervisor->name, 0, 1, 'utf8') }}</div>
                        </a>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <a href="#!" class="text-gray-800 text-hover-primary mb-1">{{ $supervisor->name }}</a>
                        <a class="text-muted"><i class="bi-mailbox2"></i> {{ $supervisor->email }}</a>
                        <a class="text-muted"><i class="bi-telephone-plus"></i>{{ $supervisor->phone }}</a>
                    </div>
                    <!--begin::User details-->
                </td>
                <td class="text-center">{{ $supervisor->section_text }}</td>
                <td class="text-center">{{ optional($supervisor->area)->name ?? '- - -'}} / {{ optional($supervisor->city)->name ?? '- - -'}}</td>
                <td class="text-center">{{ $supervisor->scopeText() }}</td>
                <td class="text-center">{{ $supervisor->associations_count }}</td>
                <td class="text-center">{{ $supervisor->created_at->toDateString() }}</td>
                <td style="white-space: nowrap; text-align: center">
                    <x-button.link href="{{ route('supervisor.edit', $supervisor) }}" class="btn-info btn-sm">تعديل</x-button.link>
                    <x-button.delete href="{{ route('supervisor.destroy', $supervisor) }}" class="btn-danger btn-sm">حذف</x-button.delete>
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
</div>

@push('script')
<script>

    $(document).ready(function () {
        // $('#area').select2();
        $('#area').on('change', function (e) {
            var data = $('#area').select2("val");
            @this.set('area', data);
        });
        $('#city').on('change', function (e) {
            var data = $('#city').select2("val");
            @this.set('city', data);
        });
        // $('#scope').on('change', function (e) {
        //     var data = $('#scope').select2("val");
        //     @this.set('scope', data);
        // });
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
