<?php

namespace App\Http\Controllers;

use App\Models\PublicAnnouncement;
use App\Models\PublicComplaint;
use App\Models\PublicRecipeLeftover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
            return Inertia::render('Admin/Announcement', [
                'announcement' => ['data' => PublicAnnouncement::get()]
            ]);
    }

    public function announcement()
    {
        return Inertia::render('Admin/Announcement', [
            'announcement' => ['data' => PublicAnnouncement::get()]
        ]);
    }

    /**
     * this is the sample query
     * select * from public_complaints where status_id = 64 and pbt_id in (select pbt_id from pc_pbt where user_id = 302);
     */
    public function complaint()
    {
        $user = User::find(auth()->id());

        $public_complaints = PublicComplaint::with(['pbt','street','status','schedule'])
                            ->where('status_id',64)
                            ->whereIn('pbt_id',$user->pc_pbt->pluck('id'))
                            ->get();


        return Inertia::render('Aduan/Tindakan',[
            'public_complaints' => $public_complaints,
            'totalAduan' => PublicComplaint::count('id'),
            'totalTindakan' => PublicComplaint::where('status_id',64)->count('id'),
            'totalBelumTindakan' => PublicComplaint::where('status_id', 65)->count('id')
        ]);
    }



    public function recipe()
    {
        return Inertia::render('Admin/RecipeLeftover', [
            'recipe' => ['data' => PublicRecipeLeftover::get()]
        ]);
    }
}
