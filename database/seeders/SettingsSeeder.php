<?php

namespace Database\Seeders;

use App\Models\GeneralSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/SettingsData.json");
        $settings=json_decode($json,true)['settings'];
        foreach ($settings as $setting) {
            $c=DB::table('settings')->where(
                [
                    'name' => $setting['name'],
                    'group' => $setting['group'],

                ])->count();
            if (!$c){
                DB::table('settings')->insert(
                    [
                        'name' => $setting['name'],
                        'group' => $setting['group'],
                        'locked' => $setting['locked'],
                        'payload' => $setting['payload'],
                    ]);
            }
        }
    }
}
