<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TanggalPeriodeBeasiswaController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/tanggalPeriodeBeasiswa');
        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $tanggalPeriode = json_decode($response->getBody()->getContents());
            $tanggalPeriodeData = $tanggalPeriode->data;
            return view('tanggalPeriodeBeasiswa.index', compact('tanggalPeriodeData'));
        }
    }

    public function create()
    {
        $responseJenisBeasiswa = $this->client->request('GET', '/api/jenisBeasiswa');
        $jenisBeasiswa = json_decode($responseJenisBeasiswa->getBody()->getContents());
        $jenisBeasiswaData = $jenisBeasiswa->data;

        $responsePeriodeBeasiswa = $this->client->request('GET', '/api/periode');
        $periodeBeasiswa = json_decode($responsePeriodeBeasiswa->getBody()->getContents());
        $periodeBeasiswaData = $periodeBeasiswa->data;

        return view('tanggalPeriodeBeasiswa.create', compact('jenisBeasiswaData', 'periodeBeasiswaData'));
    }

    public function store(Request $request)
    {
        $response = $this->client->request('POST', '/api/tanggalPeriodeBeasiswa-store', [
            'json' => $request->all()
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);

        if ($responseData['success']) {
            return redirect(route('tanggalPeriode.index'))->with('success', 'Data berhasil ditambah');
        } else {
            return redirect(route('tanggalPeriode.index'))->with('error', 'Data gagal ditambah');
        }
    }

    public function edit($id) {
        $response = $this->client->request('GET', "/api/tanggalPeriodeBeasiswa-edit/$id");
        $tanggalPeriode = json_decode($response->getBody()->getContents());
        $tanggalPeriodeData = $tanggalPeriode->data;

        $responseJenisBeasiswa = $this->client->request('GET', '/api/jenisBeasiswa');
        $jenisBeasiswa = json_decode($responseJenisBeasiswa->getBody()->getContents());
        $jenisBeasiswaData = $jenisBeasiswa->data;

        $responsePeriodeBeasiswa = $this->client->request('GET', '/api/periode');
        $periodeBeasiswa = json_decode($responsePeriodeBeasiswa->getBody()->getContents());
        $periodeBeasiswaData = $periodeBeasiswa->data;

        return view('tanggalPeriodeBeasiswa.edit', compact('tanggalPeriodeData','jenisBeasiswaData', 'periodeBeasiswaData'));
    }
}
