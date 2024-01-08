<?php

namespace App\Console\Commands;

use App\Imports\InitDataImport;
use App\Imports\InitFinancialDataImport;
use App\Imports\InitFinOrganizationImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class InitFinOrganizationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:finOrganizationdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inti finOrganizationdata';


    public function handle(): void
    {

        $this->info('Start Import Standard 3 financial organization Data');
        $file = 'org.xlsx';
        Excel::import(new InitFinOrganizationImport($this), $file);
        $this->newLine();
        $this->info('Success Import Data');

    }
}
