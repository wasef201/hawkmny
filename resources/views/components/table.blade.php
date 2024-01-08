<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 no-footer">
        <thead>
        <tr class="text-gray-600 bg-gray-100 fw-bolder fs-6 text-uppercase gs-0 text-center">
            {{ $head ?? null }}
            @if(!isset($hideAction) || !$hideAction)<th>الاجراء</th>@endif
        </tr>
        </thead>
        <tbody>
        {{ $body ?? null }}
        </tbody>
    </table>
</div>
