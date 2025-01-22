<?php

namespace App\Imports;

use App\Models\Food;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class FoodStarterImport implements OnEachRow, WithHeadingRow
{
    private const TYPE = 'starter';

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if (!isset($row['vorspeisen'])) {
            return null;
        }

        $food = new Food([
            'name' => trim($row['vorspeisen']),
            'price' => (float)trim($row['preis']),
            'type' => self::TYPE,
        ]);

        // Save directly so we can add MM relation next
        $food->save();

        foreach (explode(',', $row['weinstil']) as $style) {
            $style = (int)$style;
            if ($style) {
                $food->styles()->attach($style);
            }
        }
    }
}
