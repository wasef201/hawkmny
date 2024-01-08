<x-panel  title="المشرفين - " create-label="اضافة مشرف" create-route="supervisor.create">
	<x-slot name="toolBarActions">
        <a onclick="Livewire.emit('exportSupervisors')" class="btn btn-success"><i class="fas fa-file-excel fs-4 me-2 text-white"></i> تصدير Excel </a>
    </x-slot>

@livewire('supervisors.list-all-supervisors')
</x-panel>
