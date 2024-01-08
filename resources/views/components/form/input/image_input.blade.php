<div class="my-2 row g-0 {{ $col ?? 'col-12' }}">
    <span class="{{$labelCol??''}}">
          <x-form.input.label :label="$label??null" :id="$id ?? $name ?? ''"
                              :required="$attributes->has('required')"></x-form.input.label>
    </span>

    <div class="col">
        <div class="image-input image-input-outline image-input-empty"
             data-kt-image-input="true"
             style="background-image: url('{{ asset(theme()->getMediaUrlPath() . 'svg/files/blank-image.svg') }}')">
            {{--style="background-image: url('{{asset('demo11/media/svg/avatars/blank.svg')}}')">--}}
            <div class="image-input-wrapper w-125px h-125px" style="background-image: {!! $default??'none' !!};"></div>
            <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="change"
                data-bs-toggle="tooltip" title="{{__('admin.change_image')}}">
                <i class="bi bi-pencil-fill fs-7"></i>
                <input type="file" name="{{$name??'avatar'}}"
                       @if($form??null)
                       form="{{$form}}"
                       @endif
                       id="{{$id??$name??''}}" accept=".png, .jpg, .jpeg" {{$attributes}}/>
            </label>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                   data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{$cancelTitle??null}}">
                <i class="bi bi-x fs-2"></i>
            </label>
            @if(isset($hideExtensions))
            @else
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                       data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{$removeTitle??null}}">
                    <i class="bi bi-x fs-2"></i>
                </label>
            @endif
        </div>
        @if(isset($hideExtensions))

        @else
            <label class="d-block">{{__('admin.allowed_file_types')}}</label>
        @endif
        @error($name ?? '')<span class="invalid-feedback d-inline-block h4i">{{ $message }}</span>@enderror
    </div>
</div>


