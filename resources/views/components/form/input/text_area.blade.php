<div class="my-2 row g-0  {{ $col ?? 'col-12' }}">
    <x-form.input.label :label="$label??null" :id="$id ?? $name ?? ''" :labelCol="$labelCol??null"
                        :required="$attributes->has('required')"></x-form.input.label>

    <div class="col" >
         <textarea
             rows="3"
             name="{{$name??null}}"
             id="{{$id??($name??null)}}"
             class="form-control"
           {{$attributes}}>{{old($name??null, $attributes['value'])}}</textarea>
        @error($name ?? '')<span class="invalid-feedback d-inline-block h4i">{{ $message }}</span>@enderror
        @if($hintText??null) <span class="form-text text-muted">  {{ __($hintText) }} </span> @endif
    </div>
</div>





