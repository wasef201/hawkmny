<div>
    <div class="text-start">
        <p class='mt-2 fw-bolder'> الشواهد و الدلائل:
            <button class='uploadFile btn bnt-xs btn-primary' > <i class="fas fa-upload mr-2"></i> ارفق ملف    </button>
        </p>
        <ol class="mt-2" >
            @foreach ($this->question->verifications as $verification)
            <li>
                {{ $verification->name }}
                @php
                $files = App\Models\QuestionVerificationFile::where([
                    ['review_id' , '=' ,  $this->review->id ] ,
                    [ 'question_verification_id'  , '=' , $verification->id ],
                ])->get();
                @endphp
                @if ($files->count())
                <ul>
                    @foreach ($files as $file)
                    <li>
                        <div class="d-flex align-items-center">
                            <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black"></path>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>
                                </svg>
                            </span>
                            <a href="#!" tooltip="" style="margin-left:10px ;"  wire:click="DownloadFile({{ $file->id }})" >
                                <i class="fas fa-download text-primary"></i>
                            </a>
                            <a href="#!" style="margin-left:10px ;" class="text-gray-800 text-hover-primary">  {{ $file->file_name }}  </a>
                            <a href="#!" style="margin-left:10px ;"  class='delete_verification_file' data-file_id='{{ $file->id }}' >
                                <i class="fas fa-times text-danger"></i>
                            </a>
                            <span class="text-muted" style="margin-left:5px ;">
                                {{ $file->created_at->diffForHumans() }}
                                <i class="fas fa-alarm-clock text-info"></i>
                            </span>

                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ol>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="uploadFileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> ارفاق ملفات الشواهد </h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="" style='float:right;' class='pb-1' >  اختر الشاهد </label>
                        <select  wire:model='verification_id' class="form-control form-select">
                            <option value=""></option>
                            @foreach ($this->question->verifications as $verification)
                            <option value="{{ $verification->id }}"> {{ $verification->name }} </option>
                            @endforeach
                        </select>
                        @error('verification_id')
                        <p class="text-danger text-md"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="form-group mb-2 mt-2">
                        <label for="" style='float:right;' class='pb-1' >  الملفات </label>
                        <input type="file" multiple='multiple' class="form-control" wire:model="verification_files">
                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mt-2">
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-bold">
                                    <div class="fs-6  fw-bolder me-1">
                                        الامتدادات المسموح بها للملفات المرفقه هيا : xlsx , xlx , doc , docx , pdf , jpg , jpeg, png فقط
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('verification_files')
                        <p class="text-danger text-md"> {{ $message }} </p>
                        @enderror
                        @error('verification_files.*')
                        <p class="text-danger text-md"> {{ $message }} </p>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer" >
                    <button type="button" wire:click='uploadFiles()' class="btn btn-primary" wire:loading.attr="disabled"> اضافه </button>
                </div>
            </div>
        </div>
    </div>
</div>





@push('script')
    <script defer src="{{asset('js/flasher.js')}}"></script>

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
        window.livewire.on('alert', param => {
            switch (param['type']) {
                case 'success':

                    flasher.success(param['message'], "{{__('messages.success')}}");
                    break;
                case 'error':
                    flasher.error(param['message'], "{{__('messages.error')}}");
                    break;
                case 'info':
                    flasher.error(param['message'], "{{__('messages.error')}}");
                    break;

            }
        })

        Livewire.on('verificationFileUploaded', () => {
            $('#uploadFileModal').modal('hide');
            Toast.fire({
                icon: 'success',
                title: 'تم ارفاق ملفات الشواهد بنجاح'
            });
        })


        Livewire.on('there_is_error', () => {
            $('#uploadFileModal').modal('hide');
            Toast.fire({
                icon: 'success',
                title: 'فى مشكله فى الفاليديشن'
            });
        })









        $(document).on('click', 'button.uploadFile', function(event) {
            event.preventDefault();
            $('#uploadFileModal').modal('show');
        });

        $(document).on('click', 'a.delete_verification_file', function(event) {
            event.preventDefault();
            var file_id = $(this).attr('data-file_id');


            Swal.fire({
                title: 'تاكيد حذف الملف',
                text: "لا يمكن استرجاع الملف بعد الحذف !",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم' ,
                cancelButtonText: 'تراجع' ,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('DeleteVerificationFile' , file_id )
                }
            })
        });
    });
</script>
@endpush
