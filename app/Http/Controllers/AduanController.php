<?php

namespace App\Http\Controllers;

use App\Http\Helpers\RunningNoHelper;
use App\Mail\PCBKMail;
use App\Models\IntegrationState;
use App\Models\Pemantauan;
use App\Models\PublicComplaint;
use App\Models\PublicComplaintLampiran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AduanController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $userID = auth()->id();

        return Inertia::render('Aduan/Index', [
            'my_complaints' => PublicComplaint::select(
                'id',
                'running_no',
                'created_at',
                'status_id',
                'pbt_id',
                'street_id'
            )->with(['pbt', 'street', 'status', 'schedule'])->where('created_by', $userID)->orderByDesc('created_at')->get(),
            'totalAduan' => PublicComplaint::where('created_by', $userID)->count(),
            'aduanBaru' => PublicComplaint::where('status_id', 64)->where('created_by', $userID)->count(),
            'aduanAktif' => PublicComplaint::where('status_id', 65)->where('created_by', $userID)->count(),
            'aduanSelesai' => PublicComplaint::where('status_id', 66)->where('created_by', $userID)->count(),
            'aduanTolak' => PublicComplaint::where('status_id', 67)->where('created_by', $userID)->count(),

        ]);
    }

    public function schedule()
    {
        return Inertia::render('Aduan/Create', [
            'filters' => RequestFacade::all('aktiviti', 'negeri', 'pbt', 'taman', 'jalan', 'schedule_type'),
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
                ->when(! request('taman'), function ($q) {
                    return $q->limit(0);
                })
                ->with([
                    'activity',
                ])
                ->whereBetween('date', [
                    now()->subDays(3)->format('Y-m-d'),
                    now()->format('Y-m-d'),
                ])
                ->get(),

        ]);
    }

    public function create()
    {
        return Inertia::render('Aduan/Application', [
            'selected' => request('data'),
        ]);
    }

    public function show(PublicComplaint $complaint)
    {

        return Inertia::render('Aduan/Show', [
            'complaint' => $complaint->load(['pbt', 'street', 'status', 'schedule', 'park']),
        ]);
    }

    public function edit(PublicComplaint $complaint)
    {

        return Inertia::render('Aduan/Edit', [
            'complaint' => $complaint->load(['pbt', 'street', 'status', 'schedule', 'park']),

        ]);
    }

    public function update(Request $request, PublicComplaint $complaint)
    {
        $request->validate([
            'id' => 'required',
            'description' => 'required',
        ], [
            'description.required' => 'Sila masukkan keterangan aduan',
        ]);

        $input = $request->all();
        $file = $request->file('lampiran_aduan');
        PublicComplaint::where('id', $complaint->id)->update([
            'description' => $request->description,
            'status_id' => 64,
            'created_by' => auth()->user()->id,
        ]);

        $existingFileNames = PublicComplaintLampiran::where('public_complaint_id', $complaint->id)
            ->pluck('file_name')
            ->toArray();

        $newFileNames = array_column($input['lampiran_aduan'], 'file_name');

        $fileNamesToDelete = array_diff($existingFileNames, $newFileNames);

        PublicComplaintLampiran::where('public_complaint_id', $complaint->id)
            ->whereIn('file_name', $fileNamesToDelete)
            ->delete();

        $lampirans = [];
        if ($file) {
            foreach ($file as $fi) {
                try {
                    $url = 'https://spkkv2.swcorp.my/api/public/complaint/upload-complaint-attachment';
                    $postData = [
                        'public_complaint_id' => $complaint->id,
                    ];

                    // Create a cURL handle
                    $ch = curl_init();

                    // Set cURL options
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);

                    // Set SSL verification options to false
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                    // Build the multipart form data
                    $postData['lampiran_aduan'] = new \CURLFile($fi->getRealPath(), $fi->getClientMimeType(), $fi->getClientOriginalName());
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

                    // Execute cURL and get the response
                    $response = curl_exec($ch);

                    // Check for cURL errors
                    if (curl_errno($ch)) {
                        // Handle cURL error
                        echo 'cURL Error: '.curl_error($ch);
                    }

                    // Close cURL session
                    curl_close($ch);
                } catch (\Throwable $th) {
                    throw new \Exception($th->getMessage());
                }
            }
        }

        return back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description.required' => 'Sila masukkan keterangan aduan',
        ]);

        $schedule = Pemantauan::where('jadual_id', $request->schedule_id)->first();

        $type = '';
        $year = date('y');
        $currentMonth = date('m');
        $running_no = RunningNoHelper::generatePublicComplaintReference($schedule ? $schedule->jenis_jadual : 'X', $year, $currentMonth);
        $complaint = PublicComplaint::create([
            'running_no' => $running_no,
            'schedule_id' => $request->schedule_id,
            'description' => $request->description,
            'pbt_id' => $request->pbt_id,
            'scheme_id' => $request->scheme_id,
            'park_id' => $request->park_id,
            'street_id' => $request->street_id,
            'status_id' => 64,
            'respon_remark' => 'Untuk makluman, aduan No. Rujukan: '.$running_no.' masih dalam tindakan.

            Untuk maklumat lanjut pihak tuan/puan boleh menghubungi (No. Telefon PC) dengan menggunakan no. rujukan yang diberikan.

            Sekian, terima kasih.

            **Nota: Aduan berstatus KOMPLEKS akan mengambil masa 1 hingga 2 minggu untuk diselesaikan.',
            'status_id' => 64, //Baru
            'created_by' => auth()->user()->id,
        ]);

        session()->flash('flash.banner', 'Aduan Telah dihantar');
        session()->flash('flash.bannerStyle', 'success');

        $input = $request->all();

        $file = $request->file('lampiran_aduan');

        $lampirans = [];
        if ($file) {
            foreach ($file as $fi) {
                try {
                    $url = 'https://spkkv2.swcorp.my/api/public/complaint/upload-complaint-attachment';
                    $postData = [
                        'public_complaint_id' => $complaint->id,
                    ];

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);

                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                    $postData['lampiran_aduan'] = new \CURLFile($fi->getRealPath(), $fi->getClientMimeType(), $fi->getClientOriginalName());
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

                    $response = curl_exec($ch);

                    if (curl_errno($ch)) {
                        echo 'cURL Error: '.curl_error($ch);
                    }
                    curl_close($ch);
                } catch (\Throwable $th) {
                    throw new \Exception($th->getMessage());
                }
            }
        }

        $find_pc = User::has('pc_pbt', '=', $request->pbt_id)->first();
        $get_bk = User::where('role_id', '16')->get();

        // if ($find_pc) {
        //     Mail::to($find_pc)->send(new PCBKMail([
        //         'no_rujukan' => $running_no,
        //         'status_laporan' => 'laporkan',
        //         'no_tel_pc' => $find_pc?->phone_number
        //     ]));
        // }

        // foreach ($get_bk as $bk) {
        //     Mail::to($bk)->send(new PCBKMail([
        //         'no_rujukan' => $running_no,
        //         'status_laporan' => 'laporkan',
        //         'no_tel_pc' => $find_pc?->phone_number
        //     ]));
        // }

        return redirect(route('complaint.index'));
    }

    public function assign_ppk(Request $request)
    {
        $complaint = PublicComplaint::find($request->complaint_id);

        $ppk = User::where('id', $request->ppk['id'])->first();
        $get_bk = User::where('role_id', '16')->get();

        // if ($ppk) {
        //     Mail::to($ppk)->send(new PCBKMail([
        //         'no_rujukan' => $complaint->running_no,
        //         'status_laporan' => 'agihkan kepada ppk',

        //         'no_tel_pc' => ""
        //     ]));
        // }
        // foreach ($get_bk as $bk) {
        //     Mail::to($bk)->send(new PCBKMail([
        //         'no_rujukan' => $complaint->running_no,
        //         'status_laporan' => 'agihkan kepada ppk',
        //         'no_tel_pc' => ""
        //     ]));
        // }

        $complaint->update([
            // 'status_id' => 65,
            'take_action_by' => $request->ppk['id'],
            'assigned_by' => auth()->id(),
        ]);

        return back();
    }

    public static function storePhoto(Request $request)
    {
        $input = $request->all();

        $hash = Str::uuid();

        $file = $request->file('lampiran_aduan');
        $extension = $file->getClientOriginalExtension(); // Get the file extension
        $imageName = 'Aduan-'.$input['public_complaint_id'].'-'.$hash.'.'.$extension;
        $file->storeAs('aduan', $imageName, 'public');

        $kl = new PublicComplaintLampiran();
        $kl->public_complaint_id = $input['public_complaint_id'];
        $kl->file_name = $imageName;
        $kl->save();

        return response()->json(['status' => true, 'message' => 'Lampiran Aduan Berjaya Ditambah']);
    }
}
