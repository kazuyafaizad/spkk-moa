<?php

namespace App\Http\Controllers;

use App\Models\PublicAnnouncement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnnouncementController extends Controller
{
    public function index()
    {
        $recipe = PublicAnnouncement::with('created_by_user')->orderBy('id', 'desc')->paginate();

        return Inertia::render('Announcement/Index', [
            'recipe' => $recipe
        ]);
    }

    public function create()
    {

        return Inertia::render('Announcement/Create');
    }

    public function store(Request $request)
    {
        (new StoreRecipeLeftover)->__invoke($request);
    }

    public function show(PublicAnnouncement $recipe)
    {
        return Inertia::render('Announcement/Show', [
            'recipe' => $recipe
        ]);
    }

    public function edit(PublicAnnouncement $recipe)
    {
        return Inertia::render('Announcement/Edit', [
            'recipe' => $recipe
        ]);
    }

    public function update(Request $request)
    {
        (new EditRecipeLeftover)->__invoke($request);
    }
}
