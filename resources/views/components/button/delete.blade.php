<x-button.link onclick="event.preventDefault();deleteItem('{{ $href }}', '{{ $event ?? null }}', '{{ $data ?? null }}')" {{ $attributes }}>
    {{ $slot }}
</x-button.link>

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
