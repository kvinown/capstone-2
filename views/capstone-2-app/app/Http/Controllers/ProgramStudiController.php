<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ProgramStudiController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        try {
            $response = $this->client->request('GET', '/api/programStudi');
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $programStudi = json_decode($response->getBody()->getContents());
                $programStudiData = $programStudi->data;
                return view('programStudi.index', compact('programStudiData'));
            }
        } catch (\Exception $e) {
            return view('error', ['message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            $response = $this->client->request('GET', '/api/fakultas');
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $fakultas = json_decode($response->getBody()->getContents());
                $fakultasData = $fakultas->data;
                return view('programStudi.create', compact('fakultasData'));
            }
        } catch (\Exception $e) {
            return view('error', ['message' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $response = $this->client->request('POST', '/api/programStudi-store', [
                'json' => $request->all()
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($responseData['success']) {
                return redirect(route('programStudi.index'))->with('success', 'Data berhasil ditambah');
            } else {
                return redirect(route('programStudi.index'))->with('error', 'Data gagal ditambah');
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('programStudi.index'))->with('error', 'ID Program Studi sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('programStudi.index'))->with('error', 'Data gagal ditambah');
        } catch (\Exception $e) {
            return redirect(route('programStudi.index'))->with('error', 'Data gagal ditambah');
        }
    }
    public function edit($id){
        try {
            $responseProdi = $this->client->request('GET', "/api/programStudi-edit/{$id}");
            $programStudi = json_decode($responseProdi->getBody()->getContents());
            $programStudiData = $programStudi->data;

            $responseFakultas = $this->client->request('GET', '/api/fakultas');
            $fakultas = json_decode($responseFakultas->getBody()->getContents());
            $fakultasData = $fakultas->data;

            return view('programStudi.edit', compact('programStudiData', 'fakultasData'));
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
            $response = $this->client->request('POST', '/api/programStudi-update', [
                'json' => $request->all()
            ]);


            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($responseData['success']) {
                return redirect(route('programStudi.index'))->with('success', 'Data berhasil diubah');
            } else {
                return redirect(route('programStudi.index'))->with('error', 'Data gagal diubah');
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Contoh pemeriksaan pesan kesalahan spesifik
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('programStudi.index'))->with('error', 'ID Program Studi sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('programStudi.index'))->with('error', 'Data gagal diubah');
        } catch (\Exception $e) {
            return redirect(route('programStudi.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->client->request('GEt', "/api/programStudi-delete/{$id}");
            return redirect(route('programStudi.index'))->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect(route('programStudi.index'))->with('error', 'Data gagal dihapus');
        }
    }



}
