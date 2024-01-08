<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitiesTableSeeder extends Seeder
{

    public function run(): void
    {
       \DB::table('cities')->delete();
       \DB::table('cities')->insert($this->areas());
        foreach ($this->areas() as $area) {
            $id = $area['id'];
            $json = File::get("database/data/cities/city_$id.json");
            $cities = collect(json_decode($json,true))->map(function ($city) use($id) {
                return [
                    'parent_id' => $id,
                    'type' => 'city',
                    'name' => ucwords($city['NameArabic']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } );
            \DB::table('cities')->insert($cities->toArray());
        }
    }


    private function areas(): array
    {
        return [
            [
                'id' => 1,
                'type' => 'area',
                'name' => 'الرياض',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'type' => 'area',
                'name' => 'مكة المكرمة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'type' => 'area',
                'name' => 'المدينة المنورة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'type' => 'area',
                'name' => 'القصيم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'type' => 'area',
                'name' => 'الشرقية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'type' => 'area',
                'name' => 'عسير',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'type' => 'area',
                'name' => 'تبوك',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'type' => 'area',
                'name' => 'حائل',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'type' => 'area',
                'name' => 'الحدود الشمالية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'type' => 'area',
                'name' => 'جازان',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'type' => 'area',
                'name' => 'نجران',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'type' => 'area',
                'name' => 'الباحة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'type' => 'area',
                'name' => 'الجوف',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];
    }
}
