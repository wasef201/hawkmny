<?php

namespace App\Console\Commands;

use App\Imports\InitDataImport;
use App\Imports\InitFinancialDataImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class InitDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inti data';


    public function handle(): void
    {
        $this->info('Start Import Standard 1 Data');
        $file = 'standard_1.xlsx';
        Excel::import(new InitDataImport($this), $file);
        $this->newLine();
        $this->info('Start Import Standard 2 Data');
        $file = 'standard_2.xlsx';
        Excel::import(new InitDataImport($this), $file);
        $this->newLine();
        $this->info('Success Import Data');
    }
}
