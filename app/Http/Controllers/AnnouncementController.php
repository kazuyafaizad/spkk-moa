<?php

namespace App\Http\Controllers;

use App\Actions\EditAnnouncement;
use App\Actions\StoreAnnouncement;
use App\Models\PublicAnnouncement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcement = PublicAnnouncement::with('created_by_user')->orderBy('id', 'desc')->paginate();

        return Inertia::render('Announcement/Index', [
            'announcement' => $announcement,
        ]);
    }

    public function create()
    {

        return Inertia::render('Announcement/Create');
    }

    public function store(Request $request)
    {
        (new StoreAnnouncement)->__invoke($request);

        return redirect(route('admin.announcement.index'));
    }

    public function show(PublicAnnouncement $announcement)
    {
        return Inertia::render('Announcement/Show', [
            'announcement' => $announcement,
        ]);
    }

    public function edit(PublicAnnouncement $announcement)
    {
        return Inertia::render('Announcement/Edit', [
            'announcement' => $announcement,
        ]);
    }

    public function update(Request $request)
    {
        (new EditAnnouncement)->__invoke($request);

        return redirect(route('admin.announcement.index'));
    }

    public function destroy(PublicAnnouncement $announcement)
    {
        $announcement->delete();
        session()->flash('flash.banner', 'Pengumuman Awam Telah dipadam');
        session()->flash('flash.bannerStyle', 'error');

        return redirect(route('admin.announcement.index'));
    }
}
