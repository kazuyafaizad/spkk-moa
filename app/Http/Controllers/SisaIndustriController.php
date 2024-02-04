<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class SisaIndustriController extends Controller
{
    public function index()
    {
        return Inertia::render('Sisa/Index', [
            'filters' => RequestFacade::all('kemudahan', 'barangan', 'negeri', 'pbt', 'taman'),
        ]);
    }
}
