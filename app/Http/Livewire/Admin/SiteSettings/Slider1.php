<?php

namespace App\Http\Livewire\Admin\SiteSettings;

use App\Models\SiteDynamicSettings;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Slider1 extends BaseDynamicSettings
{


    protected function setColumns(): void
    {
        $this->columns=[
            'image',
        ];
    }

    protected function setDynamicSettingsKey(): void
    {
        $this->dynamicSettingsKey=SiteDynamicSettings::SLIDER1;
    }

    protected function setPageTitle(): void
    {
        $this->pageTitle=__('admin.slider1');
    }
}
