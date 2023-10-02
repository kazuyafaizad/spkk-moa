<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadualController;
use App\Http\Controllers\RecipeLeftoverController;
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

Route::get('/', [DashboardController::class,'index'])->name('dashboard');

Route::get('/jadual', [JadualController::class, 'index'])->name('jadual');

Route::get('/sisa-industri', function () {
    return Inertia::render('Sisa/Index', [
        'filters' => RequestFacade::all('aktiviti', 'negeri', 'pbt', 'taman'),
    ]);
})->name('sisa');

Route::get('/aduan', [AduanController::class, 'index'])->name('aduan');
Route::get('/aduan/tambah', [AduanController::class, 'create'])->name('aduan.create');

Route::get('/kitar-semula', function () {
    return Inertia::render('KitarSemula/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('kitarsemula');

Route::get('/resepi-leftover', [RecipeLeftoverController::class,'index'])->name('resepileftover');
Route::get('/resepi-leftover/create', [RecipeLeftoverController::class, 'create'])->name('resepileftover.admin');
Route::post('/resepi-leftover', [RecipeLeftoverController::class, 'store'])->name('resepileftover.admin.store');
Route::get('/resepi-leftover/show/{recipe}', [RecipeLeftoverController::class, 'show'])->name('recipe.show');


Route::get('/admin', function () {
    return Inertia::render('Admin', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('admin.index');

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
