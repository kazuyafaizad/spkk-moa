<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\IntegrationPbt;
use App\Models\IntegrationState;
use App\Models\Pemantauan;
use App\Models\PublicComplaint;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Str;

class AduanController extends Controller
{
    public function index()
    {
        return Inertia::render('Aduan/Index',[
            'my_complaints' => PublicComplaint::with(['pbt','street','status', 'schedule'])->where('created_by',auth()->id())->get()
        ]);
    }

    public function schedule()
    {
        return Inertia::render('Aduan/Create', [
            'filters' => RequestFacade::all('aktiviti', 'negeri', 'pbt', 'taman', 'jalan', 'tarikh'),
            'negeriOption' => IntegrationState::select('id', 'name')->where('act_status', 1)->get(),
            'jadual' => fn () => Pemantauan::when(request('aktiviti'), function ($q) {
                return $q->where('jenis_jadual', '=', substr(request('aktiviti'), 0, 1));
            })
                ->when(request('pbt'), function ($q) {
                    return $q->where('pbt_id', '=', request('pbt')['id']);
                })
                ->when(request('taman'), function ($q) {
                    return $q->where('park_id', '=', request('taman')['id']);
                })
                ->when(request('jalan'), function ($q) {
                    return $q->where('street_id', '=', request('jalan')['id']);
                })
                ->when(request('`tarikh`'), function ($q) {
                    return $q->where('date', '=', request('tarikh'));
                })
                ->when(!request('taman'), function ($q) {
                    return $q->limit(0);
                })
                ->get(),

        ]);
    }

    public function create()
    {
        return Inertia::render('Aduan/Application',[
            'selected' => request('data')
        ]);
    }

    public function store(Request $request)
    {

        PublicComplaint::create([
            'running_no' => $request->schedule_id ? 'SWCORP/ADUAN/' . $request->schedule_id . '/' . auth()->user()->id : 'SWCORP/ADUAN/'. auth()->user()->id,
            'schedule_id' => $request->schedule_id,
            'description' => $request->description,
            'pbt_id'  => $request->pbt_id,
            'scheme_id' => $request->scheme_id,
            'park_id' => $request->park_id,
            'street_id' => $request->street_id,
            'status_id' => 64,
            'created_by' => auth()->user()->id,
        ]);

        session()->flash('flash.banner', 'Aduan Telah dihantar');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('complaint.index'));
    }

    public function assign_ppk(Request $request)
    {
        $complaint = PublicComplaint::find($request->complaint_id);

        $complaint->update([
            'status_id' => 65,
            'take_action_by' => $request->ppk['id']
        ]);
        return back();
    }


}
