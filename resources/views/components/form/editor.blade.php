@once
    @push('script')
        <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    @endpush
@endonce
<div class="@error($name)border border-danger @enderror {{ $col ?? 'col-12' }} mb-2">
    <div class="form-group">
        <x-form.input.label :label="$label??null" :id="$id ?? $name ?? 'editor'" :required="$attributes->has('required')"></x-form.input.label>
        <textarea name="{{ $name ?? 'editor' }}" id="{{ $id ?? $name ?? 'editor' }}">{{ $slot }}</textarea>
    </div>
</div>
@push('script')
    <script>
        CKEDITOR.replace(document.getElementById('{{ $id ?? $name ?? "editor" }}'), {
                licenseKey: '',
                filebrowserImageBrowseUrl: '/filemanager?type=Images',
                filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/filemanager?type=Files',
                filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
                console.warn('Build id: kraywjl5tn6l-ovox52wnv5uk');
                console.error(error);
            });
    </script>
@endpush
