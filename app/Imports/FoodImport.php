<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FoodImport implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            2 => new FoodStarterImport(),
            3 => new FoodMainCourseImport(),
            4 => new FoodDessertImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
