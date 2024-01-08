<?php

namespace App\Console\Commands;

use App\Imports\InitFinancialDataImport;
use App\Models\Standard;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class InitFinancialPerformanceDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:finPerformanceData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Start Import Standard 3 Data');
        $file = 'standard_3.xlsx';
        Excel::import(new InitFinancialDataImport($this), $file);
        $this->newLine();
        Standard::find(1)->update(['percentage' => 40]);
        Standard::find(2)->update(['percentage' => 20]);
        $this->info('Success Import Data');

    }
}
