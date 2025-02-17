<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Food;
use App\Models\Grape;
use App\Models\Region;
use App\Models\Wine;
use App\Models\Winemaker;
use Carbon\Carbon;
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
        $maturation = $request->get('maturation') ?? null;

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

        if ($maturation) {
            $wines->where('maturation', $maturation);
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
            'maturations' => collect(['wood', 'steel']),

            'filter' => [
                'country' => $country,
                'region' => $region,
                'city' => $city,
                'winemaker' => $winemaker,
                'category' => $category,
                'style' => $style,
                'grape' => $grape,
                'maturation' => $maturation,
            ],
            'sortBy' => $sortBy,
            'sortByOrder' => $sortByOrder,
        ]);
    }

    public function wizard(Request $request)
    {
        // Question 1
        $level = $request->get('level') ?? null;

        // Question 2
        $occasion = $request->get('occasion') ?? null;

        // Question 3
        $course = $request->get('course') ?? null;
        $food = $request->get('food') ?? null;

        // Question 4 (for amateurs)
        $color = $request->get('color') ?? null;
        // Question 4 (for advanced)
        $strength = $request->get('strength') ?? null;

        // Question 5+6+7 (only for advanced!)
        $acidity = $request->get('acidity') ?? null;
        $tannin = $request->get('tannin') ?? null;
        $maturation = $request->get('maturation') ?? null;

        $options = $this->loadOptions();

        $filter = [
            'level' => $level,
            'occasion' => $occasion,
            'course' => $course,
            'food' => $food,
            'color' => $color,
            'strength' => $strength,
            'acidity' => $acidity,
            'tannin' => $tannin,
            'maturation' => $maturation,
        ];

        if ($level ?? false) {
            $wineQuery = Wine::query();
            switch ($level) {
                case 'amateur':
                    $wineQuery->where('level_sweetness', '>=', 2);
                    $wineQuery->where('selling_price', '<=', 80);
                    $wineQuery->where('maturation', 'steel');
                    break;
                case 'advanced':
                    break;
            }
            switch ($occasion) {
                case 'before':
                    if ($level === 'advanced') {
                        $wineQuery->where('level_sweetness', '>=', 2);
                    }
                    $wineQuery->where('alcohol', '<=', 13.5);
                    $wineQuery->where('vintage', '>=', Carbon::now()->modify('-3 years')->format('Y'));
                    $wineQuery->whereHas('category', function ($query) {
                        return $query->whereIn('name', ['Champagner', 'Schaumwein', 'Roséwein', 'Weißwein']);
                    });
                    break;
                case 'after':
                    $wineQuery->where('vintage', '<', Carbon::now()->modify('-5 years')->format('Y'));
                    break;
            }
            if ($food) {
                $theFood = Food::with('styles')->findOrFail($food);
                $styles = [];
                $stylesByFood = $theFood->styles->pluck('id')->toArray();
                if ($color) {
                    $stylesByColor = match($color) {
                        'green' => [1, 7, 12],
                        'yellow' => [2, 8],
                        'orange' => [3, 9, 11],
                        'red' => [4],
                        'plum' => [5, 10],
                        'purple' => [6],
                        default => [],
                    };
                    $styles = array_intersect($stylesByFood, $stylesByColor);
                }
                if ($strength) {
                    $stylesByStrength = match($strength) {
                        'light' => [1, 4, 7, 12],
                        'medium' => [2, 5, 8],
                        'strong' => [3, 6, 9, 10, 11],
                        default => [],
                    };
                    $styles = array_intersect($stylesByFood, $stylesByStrength);
                }
                if (empty($styles)) {
                    // Fallback!
                    $styles = $stylesByFood;
                }
                #dd($stylesByFood, $stylesByColor ?? null, $stylesByStrength ?? null, $styles ?? null);
                $wineQuery->whereIn('style_id', $styles);
            }

            if ($acidity) {
                $wineQuery->where('level_acidity', (int)$acidity);
            }

            if ($tannin) {
                $wineQuery->where('level_tannin', (int)$tannin);
            }

            if ($maturation) {
                $wineQuery->where('maturation', $maturation);
            }


            $wineQuery = $wineQuery->with([
                'category',
                'city',
                'region',
                'country',
                'winemaker',
                'grapes',
            ]);
        }

        return view('wine.wizard', [
            'options' => $options,
            'filter' => $filter,
            'wineQuery' => $wineQuery ?? null,
        ]);
    }

    private function loadOptions(): array
    {
        // Options are mostly defined in lang/*/wizard.php
        $options = __('wizard');

        // But the food options come from the database!
        $food = Food::get()
            ->sortBy('name')
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->name,
                    'description' => $item->description,
                    'type' => $item->type
                ];
            })
            ->groupBy('type');

        $options['food_starter']['options'] = $food['starter']->pluck('id')->combine($food['starter'])->toArray();
        $options['food_maincourse']['options'] = $food['maincourse']->pluck('id')->combine($food['maincourse'])->toArray();
        $options['food_dessert']['options'] = $food['dessert']->pluck('id')->combine($food['dessert'])->toArray();

        #debug($options);
        return $options;
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
