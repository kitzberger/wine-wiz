<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Style;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $style = $request->get('style') ?? null;
        $type = $request->get('type') ?? null;

        $foods = Food::query();

        if ($type) {
            $foods->where('type', $type);
        }

        if ($style) {
            $foods->whereHas('styles', function ($query) use ($style) {
                $query->where('style_id', $style);
            });
        }

        $foods = $foods->with([
            'styles',
        ])->get();

        return view('food.index', [
            'styles' => Style::all()->sortBy('name'),
            'foods' => $foods,
            'types' => collect(['starter', 'maincourse', 'dessert']),

            'filter' => [
                'style' => $style,
                'type' => $type,
            ],
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
    public function show(Food $food)
    {
        return view('food.show', [
            'food' => $food,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        //
    }
}
