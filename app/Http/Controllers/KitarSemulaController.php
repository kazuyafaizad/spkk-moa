<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as RequestFacade;

class KitarSemulaController extends Controller
{
    public function index()
    {
        return Inertia::render('KitarSemula/Index', [
            'filters' => RequestFacade::all('aktiviti', 'negeri', 'pbt', 'taman'),
        ]);
    }
}
