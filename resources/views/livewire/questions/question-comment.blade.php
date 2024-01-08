<div>
    <div class="mb-15">
        <h2 class='text-success' > التعليقات {{ $comments->count() }} </h2>
        @foreach ($comments as $comment)
        <div class="card card-bordered w-100">
            <div class="card-body">
                <div class="w-100 d-flex flex-stack mb-8">
                    <div class="d-flex align-items-center f">
                        <div class="symbol symbol-50px me-5">
                         <img alt="Pic" src="{{ asset('theme/media/avatars/blank.png') }}" />
                     </div>
                     <div class="d-flex flex-column fw-bold fs-5 text-gray-600 text-dark">
                        <div class="d-flex align-items-center">
                            <a href="#!" class="text-gray-800 fw-bolder text-hover-primary fs-5 me-3"> {{ optional($comment->user)->name }} </a>
                            <span class="m-0"></span>
                        </div>
                        <span class="text-muted fw-bold fs-6"> {{ $comment->created_at->diffForHumans() }}  </span>
                    </div>
                </div>
            </div>
            @if ($comment->content)
            <p class="fw-normal fs-5 text-gray-700 m-0">
                {{ $comment->content }}
            </p>
            @endif
            @if ($comment->files->count())
            <ul class="list-unstyled">
                @foreach ($comment->files as $comment_file)
                <li>
                    <div class="d-flex align-items-center">
                        <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                        <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black" />
                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                            </svg>
                        </span>
                        <a href='#!' tooltip='تحميل' style='margin-left:10px ;' wire:click='downloaFile("{{ $comment_file->id }}")' >
                            <i class="fas fa-download text-primary"></i>
                        </a>
                        <a href="#!"  style='margin-left:10px ;' class="text-gray-800 text-hover-primary">  {{ $comment_file->file_name }} </a>
                        @if (Auth::id() == optional($comment_file->comment)->user_id)
                        <a href='#!' style='margin-left:10px ;' class='delete_file' data-file_id="{{ $comment_file->id }}" >
                            <i class="fas fa-times text-danger"></i>
                        </a>
                        @endif
                        <span class='text-muted' style='margin-left:5px ;' >
                            {{ $comment_file->created_at->diffForHumans() }}
                            <i class="fas fa-alarm-clock text-info"></i>
                        </span>

                    </div>



                </li>


                @endforeach
            </ul>
            @endif
        </div>
    </div>
    @endforeach

    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
        <div class="form-group">
            <textarea name="comment" wire:model='comment' placeholder='اكتب تعليقك هنا' id="input" autofocus class="form-control" rows="3" required="required"></textarea>
            @error('comment')
            <p class='text-danger text-right'> {{ $message }} </p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="" class='form-label' > ارفق شاهد  </label> <br>
            <input type="file"  class='form-control' wire:model="files" id='files' multiple='multiple' >
            @error('files.*')
            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                <div class="d-flex flex-stack flex-grow-1">
                    <div class="fw-bold">
                        <div class="fs-6  fw-bolder me-1">
                            الامتدادات المسموح بها للملفات المرفقه هيا : xlsx , xlx , doc , docx , pdf , jpg , jpeg, png فقط
                        </div>
                    </div>
                </div>
            </div>
            @enderror
        </div>
        <br>


        <div wire:loading wire:target="files">Uploading...</div>


        <div class="form-group mt-3">
            <button style="float:left" wire:click='saveComment()' class='btn btn-primary' > إضافه  </button>
        </div>
    </div>
</div>


</div>


@push('script')
<script>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Livewire.on('commentSaved', () => {
            $("#files").val(null);
            Toast.fire({
                icon: 'success',
                title: 'تم إضافه التعلق بنجاح'
            })
        });


        Livewire.on('fileDeleted', () => {
            Toast.fire({
                icon: 'success',
                title: 'تم حذف الملف بنجاح'
            })
        });



        $(document).on('click', 'a.delete_file', function(event) {
            event.preventDefault();
            var file_id = $(this).attr('data-file_id');
            Swal.fire({
                title: 'هل انت متاكد ؟',
                text: "لا يمكن استعاده الملف بعد الحذف",
                icon: 'danger',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم',
                cancelButtonText: 'تراجع'
            }).then((result) => {
                if (result.isConfirmed) {
                     Livewire.emit('deleteFile', file_id );
                }
            })
        });






    });
</script>
@endpush
