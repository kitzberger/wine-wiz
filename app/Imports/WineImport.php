<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Grape;
use App\Models\Region;
use App\Models\Wine;
use App\Models\Winemaker;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class WineImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if (!isset($row['weinbezeichnung'])) {
            return null;
        }

        $category = Category::where('name', '=', trim($row['weingattung']))->first();
        $winemaker = Winemaker::where('name', '=', trim($row['winzer']))->first();
        $city = City::where('name', '=', trim($row['ortschaft']))
            ->whereHas('region', function (Builder $query) use ($row) {
                $query
                    ->where('name', '=', trim($row['weinbaugebiet']))
                    ->whereHas('country', function (Builder $query) use ($row) {
                        $query->where('name', '=', trim($row['land']));
                    });
            })
            ->first();
        if (is_null($city)) {
            $region = Region::where('name', '=', trim($row['weinbaugebiet']))
                ->whereHas('country', function (Builder $query) use ($row) {
                    $query->where('name', '=', trim($row['land']));
                })->first();
        } else {
            $region = $city->region;
        }
        if (is_null($region)) {
            $country = Country::where('name', '=', trim($row['land']))->first();
        } else {
            $country = $region->country;
        }

        $sugar = (float)$row['susse'];
        $sweetness = $sugar === 0.0 ? $row['susse'] : null;

        $wine = new Wine([
            'name' => $row['weinbezeichnung'],
            'selling_price' => $row['preis'],
            'purchase_price' => $row['einkaufspreis'],
            'vintage' => (int)$row['jahrgang'] ?: null,
            'plu' => $row['plu'],
            'bottle_size' => (float)$row['gebinde'],
            'alcohol' => (float)$row['alkoholgehalt'],
            'acidity' => (float)$row['saure'],
            'sugar' => $sugar,
            'sweetness' => $sweetness,
            'quality' => $row['qualitat'],
            'tannin' => $row['gerbstoff'],
            'info' => $row['zusatzinfos'],
            'maturation' => $row['ausbau'],
            'style' => $row['weinstil'],
            'winemaker_id' => $winemaker?->id,
            'category_id' => $category->id,
            'city_id' => $city?->id,
            'region_id' => $region?->id,
            'country_id' => $country?->id,
        ]);

        // Save directly so we can add MM relation next
        $wine->save();

        $grapes = collect([]);
        foreach (explode(',', $row['rebsorte']) as $name) {
            // remove any whitespaces
            $name = trim($name);
            // remove any percentage from name
            if (preg_match('/^((\d+)\s*%)?(.+)$/', $name, $matches)) {
                $percentage = (int)$matches[1];
                $name = trim($matches[3]);
                $grape = Grape::where('name', $name)->first();
                if ($grape) {
                    $wine->grapes()->attach($grape->id, ['percentage' => $percentage]);
                }
            }
        }
    }
}
