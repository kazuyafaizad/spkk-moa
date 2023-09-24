<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\JadualController;
use App\Models\IntegrationPark;
use App\Models\IntegrationPbt;
use App\Models\IntegrationScheme;
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

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('dashboard');

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

Route::get('/resepi-leftover', function () {
    return Inertia::render('ResepiLeftover/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('resepileftover');

Route::get('/admin', function () {
    return Inertia::render('Admin', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('admin.index');

Route::get('/pbt/{negeri_id}', function ($negeri_id) {
    return IntegrationPbt::where('states_id', $negeri_id)->get();
});

Route::get('/taman/{pbt_id}', function ($pbt_id) {
    $subquery = IntegrationScheme::select('id')
        ->where('pbts_id', $pbt_id);

    return IntegrationPark::whereIn('schemes_id', $subquery)->get();
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
