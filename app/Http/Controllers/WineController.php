<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Grape;
use App\Models\Region;
use App\Models\Wine;
use App\Models\Winemaker;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $country = $request->get('country') ?? null;
        $region = $request->get('region') ?? null;
        $city = $request->get('city') ?? null;
        $winemaker = $request->get('winemaker') ?? null;
        $category = $request->get('category') ?? null;
        $style = $request->get('style') ?? null;
        $grape = $request->get('grape') ?? null;

        $sortBy = $request->get('sortBy') ?? 'wine';
        $sortByOrder = $request->get('sortByOrder') ?? 'ASC';
        $sortByConfig = match ($sortBy) {
            'wine' => [['name', strtolower($sortByOrder)]],
            'winemaker' => [['winemaker', strtolower($sortByOrder)], ['name', 'asc']],
            'city' => [['city.name', strtolower($sortByOrder)], ['name', 'asc']],
            'region' => [['region.name', strtolower($sortByOrder)], ['name', 'asc']],
            'country' => [['country.name', strtolower($sortByOrder)], ['name', 'asc']],
            'category' => [['category.name', strtolower($sortByOrder)], ['name', 'asc']],
            'vintage' => [['vintage', strtolower($sortByOrder)], ['name', 'asc']],
            default => null
        };

        $wines = Wine::query();
        $regions = Region::query();
        $cities = City::query();
        $winemakers = Winemaker::query();

        if ($country) {
            $wines->where('country_id', $country);
            $regions->where('country_id', $country);
            $cities->where('country_id', $country);
            $winemakers->where('country_id', $country);
        }

        if ($region) {
            $wines->where('region_id', $region);
            $cities->where('region_id', $region);
        }

        if ($city) {
            $wines->where('city_id', $city);
        }

        if ($winemaker) {
            $wines->where('winemaker_id', $winemaker);
        }

        if ($category) {
            $wines->where('category_id', $category);
        }

        if ($style) {
            $wines->where('style', $style);
        }

        if ($grape) {
            $wines->whereHas('grapes', function ($query) use ($grape) {
                $query->where('grape_id', $grape);
            });
        }

        $wines = $wines->with([
            'category',
            'city',
            'region',
            'country',
            'winemaker',
            'grapes',
        ])->get();

        if ($sortByConfig) {
            // TODO think of something more generic
            setlocale(LC_COLLATE, 'fr_FR.utf8');
            $wines = $wines->sortBy($sortByConfig, SORT_LOCALE_STRING);
        }

        return view('wine.index', [
            'countries' => Country::all()->sortBy('name'),
            'regions' => $regions->get()->sortBy('name'),
            'cities' => $cities->get()->sortBy('name'),
            'winemakers' => $winemakers->get()->sortBy('name'),
            'wines' => $wines,
            'categories' => Category::all()->sortBy('name'),
            'styles' => collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'grapes' => Grape::all()->sortBy('name'),

            'filter' => [
                'country' => $country,
                'region' => $region,
                'city' => $city,
                'winemaker' => $winemaker,
                'category' => $category,
                'style' => $style,
                'grape' => $grape,
            ],
            'sortBy' => $sortBy,
            'sortByOrder' => $sortByOrder,
        ]);
    }

    public function wizard(Request $request)
    {
        $level = $request->get('level') ?? null;
        $occasion = $request->get('occasion') ?? null;
        $color = $request->get('color') ?? null;
        $acidity = $request->get('acidity') ?? null;
        $maturation = $request->get('maturation') ?? null;

        $options = $this->loadOptions();

        $filter = [
            'level' => $level,
            'occasion' => $occasion,
            'color' => $color,
            'acidity' => $acidity,
            'maturation' => $maturation,
        ];

        if (count(array_filter($filter)) === 5) {
            $wines = Wine::query();
            $wines = $wines->limit(5)->get();
        }


        return view('wine.wizard', [
            'wines' => $wines ?? [],
            'options' => $options,
            'filter' => $filter,
        ]);
    }

    private function loadOptions(): array
    {
        return __('wizard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wine $wine)
    {
        return view('wine.show', [
            'wine' => $wine,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wine $wine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wine $wine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wine $wine)
    {
        //
    }
}
