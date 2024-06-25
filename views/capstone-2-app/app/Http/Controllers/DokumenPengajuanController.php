<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenPengajuanController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/pengajuanBeasiswa');
        $responseDokumen = $this->client->request('GET', '/api/dokumenPengajuan');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $pengajuanBeasiswa = json_decode($response->getBody()->getContents());
            $pengajuanBeasiswaData = $pengajuanBeasiswa->data;
            $BerkasBeasiswa = json_decode($responseDokumen->getBody()->getContents());
            $BerkasBeasiswaData = $BerkasBeasiswa->data;
            return view('pengajuan.index', compact('pengajuanBeasiswaData','BerkasBeasiswaData'));
        }
    }
    public function create(Request $request)
    {
        // Retrieve the data from query parameters
        $data = $request->only(['user_id', 'periodeBeasiswa_id', 'jenisBeasiswa_id', 'ipk', 'point_portofolio']);
        // Render a view to upload additional documents
        return view('pengajuan.dokumen', compact('data'));
    }

    public function store(Request $request)
    {
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

            $response = $this->client->request('POST', '/api/dokumenPengajuan-store', [
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

            $response = $this->client->request('POST', '/api/dokumenPengajuan-store', [
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

            $response = $this->client->request('POST', '/api/dokumenPengajuan-store', [
                'json' => $data
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);
        }

        return redirect(route('pengajuanBeasiswa.index'))->with('success', 'Data berhasil ditambah');
    }

    public function edit($id){
        try {
            $responseBerkas = $this->client->request('GET', "/api/dokumenPengajuan-edit/{$id}");
            $berkas= json_decode($responseBerkas ->getBody()->getContents());
            $berkasData = $berkas->data;

            return view('pengajuan.documentEdit', compact('berkasData'));
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);
            // Handle client exception here
            return view('error', ['message' => $responseData['error']]);
        } catch (\Exception $e) {
            // Handle other exceptions here
            return view('error', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_id'=>'required|string',
            'periodeBeasiswa_id'=>'required|string',
            'jenisBeasiswa_id'=>'required|string',
            'dokumenPengajuan' => 'mimes:pdf',
            'suratEkonomiLemah' => 'mimes:pdf',
            'aktivisOrganisasi' => 'mimes:pdf'
        ]);

        try {
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
                $response = $this->client->request('POST', '/api/dokumenPengajuan-update', [
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

                $response = $this->client->request('POST', '/api/dokumenPengajuan-update', [
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

                $response = $this->client->request('POST', '/api/dokumenPengajuan-update', [
                    'json' => $data
                ]);
                $responseData = json_decode($response->getBody()->getContents(), true);
            }

            return redirect(route('dokumenBeasiswa.index'))->with('success', 'Data berhasil ditambah');
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Contoh pemeriksaan pesan kesalahan spesifik
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('dokumenBeasiswa.index'))->with('error', 'ID Fakultas sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('dokumenBeasiswa.index'))->with('error', 'Data gagal diubah');
        } catch (\Exception $e) {
            return redirect(route('dokumenBeasiswa.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
    public function destroy($id)
    {
        try {
            $response = $this->client->request('GEt', "/api/dokumenPengajuan-delete/{$id}");
            return redirect(route('dokumenPengajuan.index'))->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect(route('dokumenPengajuan.index'))->with('error', 'Data gagal dihapus');
        }
    }

}
