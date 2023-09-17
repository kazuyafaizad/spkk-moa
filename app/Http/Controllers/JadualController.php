<?php

namespace App\Http\Controllers;

use App\Models\IntegrationPbt;
use App\Models\IntegrationState;
use App\Models\Pemantauan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class JadualController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Jadual/Index', [
            'filters' => RequestFacade::all('aktiviti', 'negeri', 'pbt', 'taman'),
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
                ->when(!request('taman'), function ($q) {
                    return $q->limit(0);
                })
                ->get(),

        ]);
    }

    public function post()
    {
    }
}
