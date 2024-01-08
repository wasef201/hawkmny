<div class="d-flex flex-stack flex-wrap gap-4 mx-3">
    <div class="d-flex align-items-center fw-bolder">
        <div class="text-muted fs-3 me-2">@lang('base.main.search')</div>
        <input type="text" wire:model='search' class='form-control form-control-sm'>
    </div>
    <div class="d-flex align-items-center fw-bolder">
        <select class="form-select text-dark" wire:model='rows'>
            <option value="25" selected="selected">25</option>
            <option value="50">50</option>
            <option value="50">100</option>
        </select>
    </div>
</div>

