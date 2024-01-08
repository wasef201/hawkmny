<?php

namespace Database\Seeders;

use App\Models\FinancialInput;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FinancialInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        \DB::table('financial_inputs')->delete();
        $json = File::get("database/data/financial_input.json");
        $inputs=json_decode($json,true);
        foreach ($inputs as $record){
            FinancialInput::updateOrCreate([
                'key'=>$record['key'],

            ], [
                'label'=>$record['label'],
                'type'=>$record['type'],
                'equation'=>$record['equation'],
                'accept_zero'=>$record['accept_zero']
            ]);
        }
//        \DB::table('financial_inputs')->insert($inputs);

    }
}
