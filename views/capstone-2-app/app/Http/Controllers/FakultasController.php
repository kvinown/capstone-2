<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/fakultas');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $fakultas = json_decode($response->getBody()->getContents());
            $fakultasData = $fakultas->data;
            return view('fakultas.index', compact('fakultasData'));
        }
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(Request $request)
    {
        $response = $this->client->request('POST', '/api/fakultas-store', [
            'json' => $request->all()
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        if ($responseData['success']) {
            return redirect(route('fakultas.index'))->with('success', 'Data berhasil ditambah');
        } else {
            return redirect(route('fakultas.index'))->with('error', 'Data gagal ditambah');
        }
    }
}
