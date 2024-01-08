<x-panel  title="الجمعيات - {{ $total }}" create-label="اضافة جمعية"
          :create-route="$canCreateOrEditOrDelete ? 'association.create' : null">

    <x-slot name="toolBarActions">
        <a onclick="Livewire.emit('exportAssociations')" class="btn btn-success"><i class="fas fa-file-excel fs-4 me-2"></i> تصدير Excel </a>
    </x-slot>
    <livewire:associations.list-all-associations :can-create-or-edit-or-delete="$canCreateOrEditOrDelete" />
</x-panel>
