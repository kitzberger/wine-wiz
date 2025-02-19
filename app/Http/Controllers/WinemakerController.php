<?php

namespace App\Http\Controllers;

use App\Models\Winemaker;
use Illuminate\Http\Request;

class WinemakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('winemaker.index', [
            'winemakers' => Winemaker::get()->sortBy('name'),
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
    public function show(Winemaker $winemaker)
    {
        return view('winemaker.show', [
            'winemaker' => $winemaker,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Winemaker $winemaker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Winemaker $winemaker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Winemaker $winemaker)
    {
        //
    }
}
