<?php

namespace App\Http\Livewire\Admin\SiteSettings;

use App\Models\SiteDynamicSettings;

class Partners extends BaseDynamicSettings
{

    protected function setColumns(): void
    {
        $this->columns=[
            'image',
        ];
    }

    protected function setDynamicSettingsKey(): void
    {
        $this->dynamicSettingsKey=SiteDynamicSettings::PARTNERS;
    }

    protected function setPageTitle(): void
    {
        $this->pageTitle=__('admin.Partners');
    }

}
