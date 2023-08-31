<?php

namespace App\Http\Controllers;

use App\Models\IntegrationPbt;
use App\Models\IntegrationState;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JadualController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Jadual', [
            'negeriOption' => IntegrationState::where('act_status',1)->get(),

        ]);
    }
}
