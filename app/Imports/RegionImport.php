<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class RegionImport implements ToModel, WithUpserts, WithHeadingRow
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
        if (!isset($row['weinbaugebiet'])) {
            return null;
        }

        $country = Country::where('name', '=', $row['land'])->firstOrFail();

        $region = new Region([
            'name' => trim($row['weinbaugebiet']),
            'country_id' => $country->id,
        ]);

        return $region;
    }
}
