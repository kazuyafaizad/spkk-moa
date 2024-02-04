<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class KitarSemulaController extends Controller
{
    public function index()
    {
        return Inertia::render('KitarSemula/Index', [
            'filters' => RequestFacade::all('aktiviti', 'negeri', 'pbt', 'taman'),
            'barangan' => $this->getBarangan(),
            'kemudahan' => $this->getKemudahan(),
        ]);
    }

    public function getBarangan()
    {
        // return DB::table('ref_recycle_amenities')->where('is_active', 1)->orderBy('name')->get();

        $response = Http::withoutVerifying()->get('https://gateway.swcorp.my/myapp/api/spmtb/senaraibarang');

        if ($response->status() == 200) {
            $item = isset($response->collect()['barang']) ? $response->collect()['barang'] : [];

            return collect($item)->sort()->values()->all();
        }
    }

    public function getKemudahan()
    {
        // return DB::table('ref_item_types')->get();
        $response = Http::withoutVerifying()->get('https://gateway.swcorp.my/myapp/api/spmtb/senaraikemudahan');

        if ($response->status() == 200) {
            $item = isset($response->collect()['kemudahan']) ? $response->collect()['kemudahan'] : [];

            return collect($item)->sort()->values()->all();
        }
    }
}
