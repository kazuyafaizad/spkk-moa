<?php

namespace App\Http\Controllers;

use App\Models\PublicAnnouncement;
use App\Models\PublicComplaint;
use App\Models\PublicRecipeLeftover;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Announcement', [
            'announcement' => ['data' => PublicAnnouncement::get()],
        ]);
    }

    public function announcement()
    {
        return Inertia::render('Admin/Announcement', [
            'announcement' => ['data' => PublicAnnouncement::get()],
        ]);
    }

    /**
     * this is the sample query
     * select * from public_complaints where status_id = 64 and pbt_id in (select pbt_id from pc_pbt where user_id = 302);
     */
    public function complaint()
    {

        Gate::allowIf(fn (User $user) => ($user->role_id == 5 || $user->role_id == 2) || $user->role_id == 1 || $user->role_id == 16);

        $user = User::find(auth()->id());

        $public_complaints = PublicComplaint::with(['pbt', 'street', 'status', 'schedule', 'ppk'])
            // ->where('status_id',64)
            ->when($user->role_id == 5, function ($q) use ($user) {
                return $q->whereIn('pbt_id', $user->pc_pbt->pluck('id'));
            })
            ->orderBy('status_id', 'asc')
            ->orderByDesc('created_at')
            ->get();

        return Inertia::render('Aduan/Tindakan', [
            'public_complaints' => $public_complaints,
            'totalAduan' => PublicComplaint::when($user->role_id == 5, function ($q) use ($user) {
                return $q->whereIn('pbt_id', $user->pc_pbt->pluck('id'));
            })->count(),
            'aduanBaru' => PublicComplaint::where('status_id', 64)->when($user->role_id == 5, function ($q) use ($user) {
                return $q->whereIn('pbt_id', $user->pc_pbt->pluck('id'));
            })->count(),
            'aduanAktif' => PublicComplaint::where('status_id', 65)->when($user->role_id == 5, function ($q) use ($user) {
                return $q->whereIn('pbt_id', $user->pc_pbt->pluck('id'));
            })->count(),
            'aduanSelesai' => PublicComplaint::where('status_id', 66)->when($user->role_id == 5, function ($q) use ($user) {
                return $q->whereIn('pbt_id', $user->pc_pbt->pluck('id'));
            })->count(),
            'aduanTolak' => PublicComplaint::where('status_id', 67)->when($user->role_id == 5, function ($q) use ($user) {
                return $q->whereIn('pbt_id', $user->pc_pbt->pluck('id'));
            })->count(),
        ]);
    }

    public function recipe()
    {
        return Inertia::render('Admin/RecipeLeftover', [
            'recipe' => ['data' => PublicRecipeLeftover::get()],
        ]);
    }
}
