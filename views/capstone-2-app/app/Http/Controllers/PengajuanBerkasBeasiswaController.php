<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanBerkasBeasiswaController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }
    public function create(Request $request)
    {
        $response = $this->client->request('POST', "/api/pengajuanBerkasBeasiswa-create", [
            'json' => $request->all()
        ]);

        $data = json_decode($response->getBody()->getContents());
        dd($data);
        return view('pengajuan.dokumen');
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
