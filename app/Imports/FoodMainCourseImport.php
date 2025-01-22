<?php

namespace App\Imports;

use App\Models\Food;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class FoodMainCourseImport implements OnEachRow, WithHeadingRow
{
    private const TYPE = 'maincourse';

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if (!isset($row['hauptspeisen'])) {
            return null;
        }

        $food = new Food([
            'name' => trim($row['hauptspeisen']),
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
