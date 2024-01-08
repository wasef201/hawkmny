<div>
    <section class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">
                    {{__($pageTitle)}}
                </h3>

            </div>
            <div wire:ignore class="card-toolbar p-2">
                <x-button data-bs-toggle="modal" data-bs-target="#model_create"
                          btn="primary"
                          class="h4i btn-sm">@lang('admin.add_new')</x-button>
            </div>
        </div>
        <div class="card-toolbar">
            {{--            <livewire:component.paginate/>--}}
        </div>

        <x-table>
            <x-slot name="head">
                <th>#</th>
                @if($this->columnsHas('title'))

                    <th>{{__('admin.title')}}</th>
                @endif
                @if($this->columnsHas('image'))

                    <th>{{__('admin.image')}}</th>
                @endif
                @if($this->columnsHas('description'))
                    <th>{{__('admin.description')}}</th>
                @endif

                <th>{{__('admin.status.index')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        @if($this->columnsHas('title'))

                            <td>{{$item->title}}</td>
                        @endif
                        @if($this->columnsHas('image'))

                            <td>
                                <img class="w-45px h-45px rounded-1 ms-2" src="{{ $item->image }}"/>
                            </td>
                        @endif
                        @if($this->columnsHas('description'))

                            <td>{{$item->description}}</td>
                        @endif
                        <td>
                            {{__('admin.status.'.$item->active)}}
                            <x-button.edit-icon wire:click="edit_status({{ $item->id }})"
                                                class='btn ms-3 text-danger btn-link'
                                                data-bs-toggle="modal" data-bs-target="#modal_update_status"/>
                        </td>
                        <td wire:ignore>
                            <x-button.edit-icon wire:click="edit({{ $item->id }})"
                                                class='btn ms-3 text-danger btn-link'
                                                data-bs-toggle="modal" data-bs-target="#model_update"/>
                            <x-button.delete-icon href="#" event="delete" data="{{$item->id}}"/>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
        {{ $data->links() }}
    </section>

    <section wire:ignore.self class="modal fade" id="model_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-title mx-4 h4i pt-2">
                    {{__('admin.add_new')}}
                </div>
                <div class="modal-body pb-0">
                    <x-form wire:submit.prevent="store" id="form_store">
                        <div class="card-body border-top px-0">
                            {{--image--}}
                            @if($this->columnsHas('image'))

                                <x-form.input.image_input
                                    default="{{$new_row['image']??false?'url('.($new_row['image']->isPreviewable()?$new_row['image']->temporaryUrl():'').')':''}}"
                                    labelCol="col-4" wire:model="new_row.image" name="new_row.image"
                                    label="{{__('admin.image')}}"/>
                            @endif

                            {{--name--}}
                            <div class="row">
                                @if($this->columnsHas('title'))

                                    <x-form.input col="col-12" wire:model.defer="new_row.title" name="new_row.title"
                                                  label="{{__('admin.title')}}" required/>
                                @endif

                            </div>
                            {{--about--}}
                            @if($this->columnsHas('description'))
                                <div class="row">

                                    <x-form.input.text_area col="col-12" wire:model.defer="new_row.description"
                                                            name="new_row.description"
                                                            label="{{__('admin.description')}}"
                                                            required/>

                                </div>
                            @endif
                        </div>

                        <x-slot name="submitBtn">

                            <div class="modal-footer h5i font-inherit">
                                <x-button btn="secondary" data-bs-dismiss="modal">{{__('admin.cancel')}}</x-button>
                                <x-button btn="primary" type="submit" form="form_store">{{__('admin.save')}}</x-button>
                            </div>
                        </x-slot>
                    </x-form>

                </div>
            </div>
        </div>
    </section>
    <section wire:ignore.self class="modal fade" id="model_update" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-title mx-4 h4i pt-2">
                    {{__('admin.edit')}}
                    :
                    {{$edit_row['title']['ar']??''}}
                </div>
                <div class="modal-body pb-0">
                    <x-form wire:submit.prevent="update" id="form_update">
                        <div class="card-body border-top px-0">
                            {{--image--}}
                            @if($this->columnsHas('image'))

                                <x-form.input.image_input
                                    default="{{$edit_row['image']??false?'url('.(gettype($edit_row['image'])=='string'?$edit_row['image']:($edit_row['image']->isPreviewable()?$edit_row['image']->temporaryUrl():'')).')':''}}"
                                    labelCol="col-4" wire:model="edit_row.image" name="edit_row.image"
                                    label="{{__('admin.image')}}"/>
                            @endif

                            @if($this->columnsHas('title'))

                                {{--title--}}
                                <div class="row">
                                    <x-form.input col="col-12" wire:model.defer="edit_row.title"
                                                  name="edit_row.title"
                                                  label="{{__('admin.title')}}" required/>

                                </div>
                            @endif
                            @if($this->columnsHas('description'))

                                {{--description--}}
                                <div class="row">
                                    <x-form.input.text_area col="col-12" wire:model.defer="edit_row.description"
                                                            name="edit_row.description"
                                                            label="{{__('admin.description')}}"
                                                            required/>

                                </div>
                            @endif

                        </div>

                        <x-slot name="submitBtn">

                            <div class="modal-footer h5i font-inherit">
                                <x-button btn="secondary" data-bs-dismiss="modal">{{__('admin.cancel')}}</x-button>
                                <x-button btn="primary" type="submit" form="form_update">{{__('admin.save')}}</x-button>
                            </div>
                        </x-slot>
                    </x-form>
                </div>
            </div>
        </div>
    </section>
    <section wire:ignore.self class="modal fade" id="modal_update_status" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-title mx-4 h4i pt-2">
                    {{__('admin.edit')}}
                    :
                    {{$edit_row['title']['ar']??''}}
                </div>
                <div class="modal-body pb-0">
                    <x-form wire:submit.prevent="update_status" id="form_update_status">
                        <div class="card-body border-top px-0">
                            {{--name--}}
                            <div class="row">
                                <x-form.input.label :label="__('admin.status.index')" :required="1"
                                                    id="edit_row.status"/>
                                <div class="d-flex flex-stack gap-5 mb-3">
                                    @foreach($this->status as $item)
                                        <button type="button" wire:click="change_status('{{$item}}')"
                                                onclick="$(this).siblings().removeClass('active');"
                                                class="btn btn-light-primary w-100 {{$edit_row && $item==$edit_row['active']?'active':''}}">{{__('admin.status.'.$item)}}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <x-slot name="submitBtn">

                            <div class="modal-footer h5i font-inherit">
                                <x-button btn="secondary" data-bs-dismiss="modal">{{__('admin.cancel')}}</x-button>
                                <x-button btn="success" type="submit"
                                          form="form_update_status">{{__('admin.save')}}</x-button>
                            </div>
                        </x-slot>
                    </x-form>
                </div>

            </div>
        </div>
    </section>

</div>
@push('script')
    <script>

        window.livewire.on('store_new_row', () => {
            $('#model_create').modal('hide');
        });
        window.livewire.on('row_updated', () => {
            $('#model_update').modal('hide');
        });
        window.livewire.on('row_updated_status', () => {
            $('#modal_update_status').modal('hide');
        });
    </script>
@endpush
