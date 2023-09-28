<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeLeftoverController extends Controller
{
    public function index()
    {
        return Inertia::render('ResepiLeftover/Index');
    }

    public function list()
    {
        return Inertia::render('ReseipiLeftover/List');
    }
}
