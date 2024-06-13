<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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
}
