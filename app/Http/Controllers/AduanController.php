<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AduanController extends Controller
{
    public function index()
    {
        return Inertia::render('Aduan/Index');
    }

    public function create()
    {
        return Inertia::render('Aduan/Create');
    }
}
