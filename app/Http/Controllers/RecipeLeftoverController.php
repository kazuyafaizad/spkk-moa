<?php

namespace App\Http\Controllers;

use App\Actions\EditRecipeLeftover;
use App\Actions\StoreRecipeLeftover;
use App\Models\PublicRecipeLeftover;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeLeftoverController extends Controller
{
    public function index()
    {
        $recipe = PublicRecipeLeftover::search(request('search'))->where('status', '1')->orderBy('id', 'desc')
            // ->when(request('search'), function ($query) {
            //     $query->search(request('search'));
            // })
            ->paginate();

        return Inertia::render('ResepiLeftover/Index', [
            'recipe' => $recipe,
        ]);
    }

    public function create()
    {

        return Inertia::render('ResepiLeftover/Create');
    }

    public function store(Request $request)
    {
        (new StoreRecipeLeftover)->__invoke($request);

        return redirect(route('admin.recipe.index'));
    }

    public function show(PublicRecipeLeftover $recipe)
    {
        return Inertia::render('ResepiLeftover/Show', [
            'recipe' => $recipe,
            'recipe_recommend' => PublicRecipeLeftover::inRandomOrder()->where('status', '1')->limit(5)->get(),
        ]);
    }

    public function edit(PublicRecipeLeftover $recipe)
    {
        return Inertia::render('ResepiLeftover/Edit', [
            'recipe' => $recipe,
        ]);
    }

    public function update(Request $request)
    {
        (new EditRecipeLeftover)->__invoke($request);

        return redirect(route('admin.recipe.index'));
    }

    public function destroy(PublicRecipeLeftover $recipe)
    {
        $recipe->delete();
        session()->flash('flash.banner', 'Resepi Telah dipadam');
        session()->flash('flash.bannerStyle', 'error');

        return redirect(route('admin.recipe.index'));
    }
}
