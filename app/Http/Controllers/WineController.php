<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use Illuminate\Http\Request;

class WineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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

        $wines = Wine::with(['category', 'city', 'region', 'country'])->get();

        if ($sortByConfig) {
            // TODO think of something more generic
            setlocale(LC_COLLATE, 'fr_FR.utf8');
            $wines = $wines->sortBy($sortByConfig, SORT_LOCALE_STRING);
        }

        return view('wine.index', [
            'wines' => $wines,
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
