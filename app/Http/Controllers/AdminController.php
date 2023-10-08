<?php

namespace App\Http\Controllers;

use App\Models\PublicRecipeLeftover;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
            return Inertia::render('Admin', [
                'recipe' => PublicRecipeLeftover::orderBy('id','desc')->paginate()
            ]);
    }
}
