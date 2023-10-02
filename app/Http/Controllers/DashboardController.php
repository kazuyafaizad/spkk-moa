<?php

namespace App\Http\Controllers;

use App\Models\Pemantauan;
use App\Models\PublicRecipeLeftover;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
   public function index()
   {


        return Inertia::render('Dashboard',[
            'recipe' => Inertia::lazy(fn () => PublicRecipeLeftover::search(request('search'))->paginate()),
            'jadual' => Inertia::lazy(fn () => Pemantauan::search(request('search'))->paginate()),
        ]);
   }
}
