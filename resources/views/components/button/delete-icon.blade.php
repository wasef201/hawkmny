<a onclick="event.preventDefault();deleteItem('{{ $href }}', '{{ $event ?? null }}', '{{ $data ?? null }}')" {{ $attributes->class('p-0 mx-1') }}>
    <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen040.svg-->
    <span class="svg-icon svg-icon-danger svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
</svg></span>
    <!--end::Svg Icon-->
</a>

@once
@push('script')
<script>
    function deleteItem(url, event, data) {
        Swal.fire({
            title: 'هل انت متاكد من عملية الحذف؟',
            categorie: "warning",
            confirmButtonClass: "btn-danger text-white",
            confirmButtonText: "نعم، احذف",
            cancelButtonText: "الغاء",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                @if($event ?? null)
                    Livewire.emit(event, data);
                @else
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {_token: '{!! csrf_token() !!}', _method : 'delete' }
                })
                    .done(function() {
                        Swal.fire({
                                title: "", text: "تمت عملية الحذف بنجاح", categorie: "success",
                                preConfirm: () => location.reload()
                            });
                    })
                    .fail(function(e) {
                        Swal.fire("وقع خطأ اثماء عملية الحذف",e.responseJSON.message, "error")
                    });
                @endif
            },
        });
    }
</script>
@endpush
@endonce
