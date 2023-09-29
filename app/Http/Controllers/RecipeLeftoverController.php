<?php

namespace App\Http\Controllers;

use App\Actions\StoreRecipeLeftover;
use App\Models\PublicRecipeLeftover;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeLeftoverController extends Controller
{
    public function index()
    {
        $resepi = PublicRecipeLeftover::all();

        return Inertia::render('ResepiLeftover/Index',[
            'resepi' => $resepi
        ]);
    }

    public function create()
    {
        $resepi = PublicRecipeLeftover::all();

        return Inertia::render('ResepiLeftover/Create', [
            'resepi' => $resepi
        ]);
    }

    public function store(Request $request)
    {
        (new StoreRecipeLeftover)->__invoke($request);
    }
}
