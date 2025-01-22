<?php

namespace App\Console\Commands;

use App\Imports\CategoryImport;
use App\Imports\CityImport;
use App\Imports\CountryImport;
use App\Imports\FoodImport;
use App\Imports\GrapeImport;
use App\Imports\RegionImport;
use App\Imports\WineImport;
use App\Imports\WinemakerImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcel extends Command
{
    private const FILE = 'wines.xlsx';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-excel {file?}';

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
        $file = $this->argument('file') ?? self::FILE;

        $this->info('Importing file: ' . $file);

        // file must be located in storage/app/private/
        Excel::import(new CategoryImport, $file);
        Excel::import(new GrapeImport, $file);
        Excel::import(new CountryImport, $file);
        Excel::import(new RegionImport, $file);
        Excel::import(new CityImport, $file);
        Excel::import(new WinemakerImport, $file);
        Excel::import(new WineImport, $file);
        Excel::import(new FoodImport, $file);

        $this->info('The import was successful!');
    }
}
