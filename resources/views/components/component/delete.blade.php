<section class="modal fade" id="model_delete" tabindex="-1" aria-labelledby="DeleteModelLabel"
         aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                {{__('base.main.confirm_delete_message')}}
            </div>
            <div class="modal-footer h5i font-inherit">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{__('base.main.cancel')}}</button>
                <button type="button" id="confirm_delete" wire:click="delete" data-bs-dismiss="modal"
                        class="btn btn-danger">{{__('base.main.delete')}}</button>
            </div>
        </div>
    </div>
</section>
