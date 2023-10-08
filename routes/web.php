<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadualController;
use App\Http\Controllers\KitarSemulaController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RecipeLeftoverController;
use App\Http\Controllers\SisaIndustriController;
use App\Models\IntegrationPark;
use App\Models\IntegrationPbt;
use App\Models\IntegrationScheme;
use App\Models\IntegrationStreet;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as RequestFacade;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    // Dashboard Route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    // Jadual Routes
    Route::prefix('jadual')->name('jadual.')->group(function () {
        Route::get('/', [JadualController::class, 'index'])->name('index');
    });


    // Sisa Industri Route
    Route::prefix('sisa-industri')->name('sisaindustri.')->group(function () {
        Route::get('/', [SisaIndustriController::class, 'index'])->name('index');
    });


    // Aduan Routes
    Route::prefix('aduan')->name('complaint.')->group(function () {
        Route::get('/', [AduanController::class, 'index'])->name('index');
        Route::middleware('auth')->group(function () {
            Route::get('/tambah', [AduanController::class, 'create'])->name('create');
        });
    });


    // Kitar Semula Route
    Route::prefix('kitar-semula')->name('kitarsemula.')->group(function () {
        Route::get('/', [KitarSemulaController::class, 'index'])->name('index');
    });


    // Resepi Leftover Routes
    Route::prefix('resepi-leftover')->name('resepileftover.')->group(function () {
        Route::get('/', [RecipeLeftoverController::class, 'index'])->name('index');
        Route::get('/tambah', [RecipeLeftoverController::class, 'create'])->name('create');
        Route::post('/', [RecipeLeftoverController::class, 'store'])->name('store');
        Route::put('/', [RecipeLeftoverController::class, 'update'])->name('update');
        Route::get('/id/{recipe}', [RecipeLeftoverController::class, 'show'])->name('show');
        Route::get('/edit/{recipe}', [RecipeLeftoverController::class, 'edit'])->name('edit');
    });


    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
    });


     // Annoucement Routes
    Route::prefix('announcement')->name('announcement.')->group(function () {
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::get('/tambah', [AnnouncementController::class, 'create'])->name('create');
    Route::post('/', [AnnouncementController::class, 'store'])->name('store');
    Route::put('/', [AnnouncementController::class, 'update'])->name('update');
    Route::get('/id/{announcement}', [AnnouncementController::class, 'show'])->name('show');
    Route::get('/edit/{announcement}', [AnnouncementController::class, 'edit'])->name('edit');
    });




    Route::get('/pbt/{negeri_id}', function ($negeri_id) {
        return IntegrationPbt::select('id', 'name')->where('states_id', $negeri_id)->get();
    });

    Route::get('/taman/{pbt_id}', function ($pbt_id) {
        $subquery = IntegrationScheme::select('id')
            ->where('pbts_id', $pbt_id);

        return IntegrationPark::select('id', 'name')->whereIn('schemes_id', $subquery)->get();
    });

    Route::get('/jalan/{park_id}', function ($park_id) {
        return IntegrationStreet::select('id','name')->where('parks_id', $park_id)->get();
    });


    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        // Route::get('/dashboard', function () {
        //     return Inertia::render('Dashboard');
        // })->name('dashboard');
    });
