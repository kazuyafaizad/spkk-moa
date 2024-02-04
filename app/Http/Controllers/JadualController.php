<?php

namespace App\Http\Controllers;

use App\Models\IntegrationState;
use App\Models\Pemantauan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class JadualController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Jadual/Index', [
            'filters' => RequestFacade::all('aktiviti', 'negeri', 'pbt', 'taman', 'jalan', 'tarikh', 'schedule_type'),
            'negeriOption' => IntegrationState::select('id', 'name')->where('act_status', 1)->get(),
            'jadual' => fn () => Pemantauan::when(request('aktiviti'), function ($q) {
                return $q->where('activity_code', '=', request('aktiviti')['kod_aktiviti']);
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
                ->when(request('tarikh'), function ($q) {
                    $start_date = Carbon::parse(request('tarikh')[0])->startOfDay();
                    $end_date = Carbon::parse(request('tarikh')[1])->endOfDay();

                    return $q->whereBetween('date', [$start_date, $end_date]);
                })
                ->when(! request('tarikh'), function ($q) {
                    return $q->whereMonth('date', Carbon::now()->month);
                })
                ->when(! request('taman'), function ($q) {
                    return $q->limit(0);
                })
                ->with([
                    'activity',
                ])
                ->select('jadual_id', 'park_name', 'street_name', 'time_start', 'time_end', 'date', 'activity_code')
                ->orderBy('date', 'asc')
                ->get(),

        ]);
    }

    public function post()
    {
    }
}
