<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\IntegrationPbt;
use App\Models\IntegrationState;
use App\Models\Pemantauan;
use Illuminate\Support\Facades\Request as RequestFacade;

class AduanController extends Controller
{
    public function index()
    {
        return Inertia::render('Aduan/Index');
    }

    public function create()
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
}
