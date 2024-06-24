<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $response = $this->client->request('GET', '/api/pengajuanBeasiswa');
        $responseDokumen = $this->client->request('GET', '/api/pengajuanBerkasBeasiswa');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $pengajuanBeasiswa = json_decode($response->getBody()->getContents());
            $pengajuanBeasiswaData = $pengajuanBeasiswa->data;
            $BerkasBeasiswa = json_decode($responseDokumen->getBody()->getContents());
            $BerkasBeasiswaData = $BerkasBeasiswa->data;
            return view('pengajuan.index', compact('pengajuanBeasiswaData','BerkasBeasiswaData'));
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
        $data=[
            'user_id'=> auth()->id(),
            'periodeBeasiswa_id' => $request->periodeBeasiswa_id,
            'jenisBeasiswa_id' => $request->jenisBeasiswa_id,
            'ipk' => $request->ipk,
            'point_portofolio' => $request->point_portofolio,
        ];
        $response = $this->client->request('POST', '/api/pengajuanBeasiswa-store', [
            'json' => $data
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        if ($responseData['success']) {
            return redirect(route('pengajuanBeasiswa.dokumen'))->with('success', 'Data berhasil ditambah');
        } else {
            return redirect(route('pengajuanBeasiswa.index'))->with('error', 'Data gagal ditambah');
        }
    }

    public function createDokumen(){
        $data = DB::table('pengajuanBeasiswa')->where('users_id',auth()->id())->first();

        return view('pengajuan.dokumen',['data' => $data]);
    }

    public function storeDokumen(Request $request){

        $request->validate([
            'user_id'=>'required|string',
            'periodeBeasiswa_id'=>'required|string',
            'jenisBeasiswa_id'=>'required|string',
            'dokumenPengajuan' => 'required|mimes:pdf',
            'suratEkonomiLemah' => 'mimes:pdf',
            'aktivisOrganisasi' => 'mimes:pdf'
        ]);

        if ($request->hasFile('dokumenPengajuan')) {
            $file = $request->file('dokumenPengajuan');
            $path = $file->storeAs('public/dokumenPengajuan/'.auth()->id(), $file->getClientOriginalName());
            $data=[
                'users_id'=> $request->user_id,
                'periodeBeasiswa_id'=>$request->periodeBeasiswa_id,
                'jenisBeasiswa_id'=>$request->jenisBeasiswa_id,
                'jenisDokumen_id'=>'1',
                'path'=>Storage::url($path)
            ];

            $response = $this->client->request('POST', '/api/pengajuanBerkasBeasiswa-store', [
                'json' => $data
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);
        }

        if ($request->hasFile('suratEkonomiLemah')) {
            $file = $request->file('suratEkonomiLemah');
            $path = $file->storeAs('public/suratEkonomiLemah/'.auth()->id(), $file->getClientOriginalName());

            $data=[
                'users_id'=> $request->user_id,
                'periodeBeasiswa_id'=>$request->periodeBeasiswa_id,
                'jenisBeasiswa_id'=>$request->jenisBeasiswa_id,
                'jenisDokumen_id'=>'2',
                'path'=>Storage::url($path)
            ];

            $response = $this->client->request('POST', '/api/pengajuanBerkasBeasiswa-store', [
                'json' => $data
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);
        }

        if ($request->hasFile('aktivisOrganisasi')) {
            $file = $request->file('aktivisOrganisasi');
            $path = $file->storeAs('public/aktivisOrgansisasi/'.auth()->id(), $file->getClientOriginalName());
            $data=[
                'users_id'=> $request->user_id,
                'periodeBeasiswa_id'=>$request->periodeBeasiswa_id,
                'jenisBeasiswa_id'=>$request->jenisBeasiswa_id,
                'jenisDokumen_id'=>'3',
                'path'=>Storage::url($path)
            ];

            $response = $this->client->request('POST', '/api/pengajuanBerkasBeasiswa-store', [
                'json' => $data
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);
        }

        return redirect(route('pengajuanBeasiswa.index'))->with('success', 'Data berhasil ditambah');

    }
}
