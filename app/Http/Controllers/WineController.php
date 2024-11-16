<?php

namespace App\Http\Controllers;

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
            'grapes' => Grape::all()->sortBy('name'),

            'filter' => [
                'country' => $country,
                'region' => $region,
                'city' => $city,
                'winemaker' => $winemaker,
                'grape' => $grape,
            ],
            'sortBy' => $sortBy,
            'sortByOrder' => $sortByOrder,
        ]);
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
        //
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
