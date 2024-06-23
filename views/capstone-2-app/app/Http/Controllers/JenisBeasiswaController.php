<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class JenisBeasiswaController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/jenisBeasiswa');
        $statusCode = $response->getStatusCode();
        if ($statusCode === 200) {
            $jenisBeasiswa = json_decode($response->getBody()->getContents());
            $jenisBeasiswaData = $jenisBeasiswa->data;
            return view('jenisBeasiswa.index', compact('jenisBeasiswaData'));
        }
    }

    public function create()
    {
        return view('jenisBeasiswa.create');
    }

    public function store(Request $request)
    {
        $response = $this->client->request('POST', "/api/jenisBeasiswa-store", [
            'json' => $request->all()
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        if ($responseData['success']) {
            return redirect(route('jenisBeasiswa.index'))->with('success', 'Data berhasil ditambah');
        } else {
            return redirect(route('jenisBeasiswa.index'))->with('error', 'Data gagal ditambah');
        }
    }

    public function edit($id)
    {
        try {
            $responseJenis = $this->client->request('GET', "/api/jenisBeasiswa-edit/{$id}");
            $jenisBeasiswa = json_decode($responseJenis->getBody()->getContents());
            $jenisBeasiswaData = $jenisBeasiswa->data;

            return view('jenisBeasiswa.edit', compact('jenisBeasiswaData'));
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
        try {
            $response = $this->client->request('POST', '/api/jenisBeasiswa-update', [
                'json' => $request->all()
            ]);


            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($responseData['success']) {
                return redirect(route('jenisBeasiswa.index'))->with('success', 'Data berhasil diubah');
            } else {
                return redirect(route('jenisBeasiswa.index'))->with('error', 'Data gagal diubah');
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Contoh pemeriksaan pesan kesalahan spesifik
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('jenisBeasiswa.index'))->with('error', 'ID Jenis Beasiswa sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('jenisBeasiswa.index'))->with('error', 'Data gagal diubah');
        } catch (\Exception $e) {
            return redirect(route('jenisBeasiswa.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $response = $this->client->request('GEt', "/api/jenisBeasiswa-delete/{$id}");
            return redirect(route('jenisBeasiswa.index'))->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect(route('jenisBeasiswa.index'))->with('error', 'Data gagal dihapus');
        }

    }
}
