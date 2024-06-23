<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanBeasiswaController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/pengajuanBerkasBeasiswa');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $pengajuanBeasiswa = json_decode($response->getBody()->getContents());
            $pengajuanBeasiswaData = $pengajuanBeasiswa->data;
            return view('pengajuan.index', compact('pengajuanBeasiswaData'));
        }
    }

    public function create()
    {
        try {
            $response = $this->client->request('GET', '/api/periode');
            $responseJenis = $this->client->request('GET', '/api/jenisBeasiswa');
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $periodeBeasiswa = json_decode($response->getBody()->getContents());
                $periodeBeasiswaData = $periodeBeasiswa->data;
                $jenisBeasiswa = json_decode($responseJenis->getBody()->getContents());
                $jenisBeasiswaData = $jenisBeasiswa->data;
                return view('pengajuan.create', compact('periodeBeasiswaData','jenisBeasiswaData'));
            }
        } catch (\Exception $e) {
            return view('error', ['message' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $paths=[];
        if ($request->hasFile('dokumenPengajuan')) {
            $file = $request->file('dokumenPengajuan');
            $path = $file->storeAs('public/dokumenPengajuan', $file->getClientOriginalName());
            $paths['dokumenPengajuan'] = Storage::url($path);
        }

        if ($request->hasFile('suratEkonomiLemah')) {
            $file = $request->file('suratEkonomiLemah');
            $path = $file->storeAs('public/suratEkonomiLemah', $file->getClientOriginalName());
            $paths['suratEkonomiLemah'] = Storage::url($path);
        }

        if ($request->hasFile('aktivisOrganisasi')) {
            $file = $request->file('aktivisOrganisasi');
            $path = $file->storeAs('public\aktivisOrgansisasi', $file->getClientOriginalName());
            $paths['aktivisOrganisasi'] = Storage::url($path);
        }

//        if ($request->hasFile('dokumenPendukung')) {
//            $files = $request->file('dokumenPendukung');
//            $dokumenPendukungPaths = [];
//            foreach ($files as $file) {
//                $path = $file->storeAs('public/dokumenPendukung', $file->getClientOriginalName());
//                $dokumenPendukungPaths[] = Storage::url($path);
//            }
//            $paths['dokumenPendukung'] = $dokumenPendukungPaths;
//        }

        $data = [
            'user_id'=> auth()->id(),
            'periodeBeasiswa_id' => $request->periodeBeasiswa_id,
            'jenisBeasiswa_id'=> $request->jenisBeasiswa_id,
            'paths'=>$paths
        ];

        $response = $this->client->request('POST', '/api/pengajuanBerkasBeasiswa-store', [
            'json' => $data
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        if ($responseData['success']) {
            return redirect(route('fakultas.index'))->with('success', 'Data berhasil ditambah');
        } else {
            return redirect(route('fakultas.index'))->with('error', 'Data gagal ditambah');
        }
    }
}
