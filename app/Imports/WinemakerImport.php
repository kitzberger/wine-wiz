<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Winemaker;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class WinemakerImport implements ToModel, WithUpserts, WithHeadingRow
{
    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'name';
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['winzer'])) {
            return null;
        }

        $country = Country::where('name', '=', $row['land'])->firstOrFail();

        return new Winemaker([
            'name' => trim($row['winzer']),
            'info' => trim($row['winzer_infos']),
            'country_id' => $country->id,
        ]);
    }
}
