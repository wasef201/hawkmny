<?php

namespace App\Http\Livewire\Admin\SiteSettings;

use App\Models\SiteDynamicSettings;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class HokmnyAdvantages extends BaseDynamicSettings
{


    protected function setColumns(): void
    {
        $this->columns=[
            'image',
            'title',
            'description'
        ];
    }

    protected function setDynamicSettingsKey(): void
    {
        $this->dynamicSettingsKey=SiteDynamicSettings::HOKMNY_ADVANTAGES;
    }

    protected function setPageTitle(): void
    {
        $this->pageTitle=__('admin.hokmny_advantages');
    }
}
