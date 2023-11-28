<?php

namespace App\Http\Controllers;

use App\Actions\StoreRecipeLeftover;
use App\Actions\EditRecipeLeftover;
use App\Models\PublicRecipeLeftover;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeLeftoverController extends Controller
{
    public function index()
    {
        $recipe = PublicRecipeLeftover::with('created_by_user')->orderBy('id','desc')->paginate();

        return Inertia::render('ResepiLeftover/Index',[
            'recipe' => $recipe
        ]);
    }

    public function create()
    {

        return Inertia::render('ResepiLeftover/Create');
    }

    public function store(Request $request)
    {
        (new StoreRecipeLeftover)->__invoke($request);
    }

    public function show(PublicRecipeLeftover $recipe)
    {
        return Inertia::render('ResepiLeftover/Show', [
            'recipe' => $recipe
        ]);
    }

    public function edit(PublicRecipeLeftover $recipe)
    {
        return Inertia::render('ResepiLeftover/Edit', [
            'recipe' => $recipe
        ]);
    }

    public function update(Request $request)
    {
        (new EditRecipeLeftover)->__invoke($request);
    }

    public function destroy(PublicRecipeLeftover $recipe)
    {
        $recipe->delete();

        return back()->with('message', 'Telah Berjaya dipadam');
    }
}
