<?php

namespace Database\Seeders;

use App\Models\SiteDynamicSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DynamicSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = File::get("database/data/dynamicSettingsData.json");
        $settings=json_decode($json,true)['site_dynamic_settings'];
        SiteDynamicSettings::insert($settings);
    }
}
