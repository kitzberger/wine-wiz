<?php

namespace App\Imports;

use App\Models\Grape;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class GrapeImport implements ToModel, WithUpserts, WithHeadingRow
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
        if (!isset($row['rebsorte'])) {
            return null;
        }

        $grapes = [];

        foreach (explode(',', $row['rebsorte']) as $grape) {
            // remove any whitespaces
            $name = trim($grape);
            // remove any percentage from name
            $name = preg_replace('/(\d+)%/', '', $name);

            $name = trim($name);

            $grapes[] = new Grape([
                'name' => $name,
            ]);
        }

        return $grapes;
    }
}
