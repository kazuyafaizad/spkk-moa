<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadualController;
use App\Http\Controllers\KitarSemulaController;
use App\Http\Controllers\RecipeLeftoverController;
use App\Http\Controllers\SisaIndustriController;
use App\Models\IntegrationActivities;
use App\Models\IntegrationPark;
use App\Models\IntegrationPbt;
use App\Models\IntegrationScheme;
use App\Models\IntegrationStreet;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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

    Route::middleware('auth')->group(function () {
        Route::get('/', [AduanController::class, 'index'])->name('index');
        Route::get('/jadual', [AduanController::class, 'schedule'])->name('schedule');
        Route::get('/tambah', [AduanController::class, 'create'])->name('create');
        Route::post('/simpan', [AduanController::class, 'store'])->name('store');
        Route::get('/show/{complaint}', [AduanController::class, 'show'])->name('show');
        Route::get('/edit/{complaint}', [AduanController::class, 'edit'])->name('edit');
        Route::post('/update/{complaint}', [AduanController::class, 'update'])->name('update');
    });
});

// Kitar Semula Route
Route::prefix('kitar-semula')->name('kitarsemula.')->group(function () {
    Route::get('/', [KitarSemulaController::class, 'index'])->name('index');
});

// Resepi Leftover Routes
Route::prefix('resepi-leftover')->name('recipe.')->group(function () {
    Route::get('/', [RecipeLeftoverController::class, 'index'])->name('index');
    Route::get('/{recipe}', [RecipeLeftoverController::class, 'show'])->name('show');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/complaint', [AdminController::class, 'complaint'])->name('complaint');

    Route::post('/complaint/assign_ppk', [AduanController::class, 'assign_ppk'])->name('assign_ppk');

    // Annoucement Routes
    Route::prefix('announcement')->name('announcement.')->group(function () {
        Route::get('/', [AdminController::class, 'announcement'])->name('index');
        Route::get('/tambah', [AnnouncementController::class, 'create'])->name('create');
        Route::post('/', [AnnouncementController::class, 'store'])->name('store');
        Route::put('/', [AnnouncementController::class, 'update'])->name('update');
        Route::get('/id/{announcement}', [AnnouncementController::class, 'show'])->name('show');
        Route::get('/edit/{announcement}', [AnnouncementController::class, 'edit'])->name('edit');
        Route::delete('/delete/{announcement}', [AnnouncementController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('resepi-leftover')->name('recipe.')->group(function () {
        Route::get('/', [AdminController::class, 'recipe'])->name('index');
        Route::get('/tambah', [RecipeLeftoverController::class, 'create'])->name('create');
        Route::post('/', [RecipeLeftoverController::class, 'store'])->name('store');
        Route::put('/', [RecipeLeftoverController::class, 'update'])->name('update');
        Route::get('/edit/{recipe}', [RecipeLeftoverController::class, 'edit'])->name('edit');
        Route::delete('/delete/{recipe}', [RecipeLeftoverController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/pbt/{negeri_id}', function ($negeri_id) {
    return IntegrationPbt::select('id', 'name')->where('status', 1)->where('states_id', $negeri_id)->get();
});

Route::get('/taman/{pbt_id}', function ($pbt_id) {
    $subquery = IntegrationScheme::select('id')
        ->where('status', 1)
        ->where('pbts_id', $pbt_id);

    return IntegrationPark::select('id', 'name')->where('status', 1)->whereIn('schemes_id', $subquery)->orderBy('name', 'asc')->get();
});

Route::get('/jalan/{park_id}', function ($park_id) {
    return IntegrationStreet::select('id', 'name')->where('status', 1)->where('parks_id', $park_id)->get();
});

Route::get('/scheme/{pbt_id}', function ($pbt_id) {
    return IntegrationScheme::select('id', 'name')->where('status', 1)->where('pbts_id', $pbt_id)->get();
});

Route::get('/ppk/{pbt_id}', function ($pbt_id) {
    return User::select('id', 'name')->where('pbt_id', $pbt_id)->where('role_id', 4)->get();
});

Route::get('/activities/{schedule_type}', function ($schedule_type) {
    return IntegrationActivities::select('kod_aktiviti', DB::raw('CASE WHEN kod_aktiviti = "KB" THEN "SISA PUKAL/SISA TAMAN/ SISA KITAR SEMULA" ELSE keterangan END AS name'))
        ->where('jenis_perkhidmatan_id', $schedule_type)
        ->where('kod_status', 1)
        ->get();
});

Route::get('/imgdsd/{path}', function ($path) {

    $decoded_path = base64_decode($path);

    return Storage::disk('sftp')->get(ltrim($decoded_path, '/'));

})->name('img-ge');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');
});
