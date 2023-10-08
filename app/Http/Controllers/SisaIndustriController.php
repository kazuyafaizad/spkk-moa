<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as RequestFacade;

class SisaIndustriController extends Controller
{
    public function index()
    {
        return Inertia::render('Sisa/Index', [
            'filters' => RequestFacade::all('kemudahan','barangan', 'negeri', 'pbt', 'taman'),
        ]);
    }
}
