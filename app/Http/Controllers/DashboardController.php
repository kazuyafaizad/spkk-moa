<?php

namespace App\Http\Controllers;

use App\Models\Pemantauan;
use App\Models\PublicAnnouncement;
use App\Models\PublicRecipeLeftover;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'announcement' => PublicAnnouncement::readyToDisplay()->first(),
            'recipe' => Inertia::lazy(fn () => PublicRecipeLeftover::search(request('search'))->paginate(3)),
            'jadual' => Inertia::lazy(fn () => Pemantauan::search(request('search'))->paginate(3)),
        ]);
    }
}
