<?php

namespace App\Console\Commands;

use App\Imports\CategoryImport;
use App\Imports\CityImport;
use App\Imports\CountryImport;
use App\Imports\GrapeImport;
use App\Imports\RegionImport;
use App\Imports\WineImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import full excel file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // file must be located in storage/app/private/
        Excel::import(new CategoryImport, 'wines.xlsx');
        Excel::import(new GrapeImport, 'wines.xlsx');
        Excel::import(new CountryImport, 'wines.xlsx');
        Excel::import(new RegionImport, 'wines.xlsx');
        Excel::import(new CityImport, 'wines.xlsx');
        Excel::import(new WineImport, 'wines.xlsx');
    }
}
