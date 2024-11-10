<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CityImport implements ToModel, WithUpserts, WithHeadingRow
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
        if (!isset($row['ortschaft'])) {
            return null;
        }

        $region = Region::where('name', '=', trim($row['weinbaugebiet']))
            ->whereHas('country', function (Builder $query) use ($row) {
                $query->where('name', '=', trim($row['land']));
            })
            ->firstOrFail();

        $city = new City([
            'name' => trim($row['ortschaft']),
            'region_id' => $region->id,
        ]);

        return $city;
    }
}
