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
        $response = $this->client->request('GET', '/api/fakultas-create');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            return view('fakultas.create');
        } else {
            // Handle error or return an appropriate response/view
            return view('error'); // Ensure you have an error view
        }
    }

    public function store(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'nama' => $request->input('nama'),
        ];

        $response = $this->client->request('POST', '/api/fakultas-store', [
            'json' => $data
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            return view('fakultas.store');
        } else {
            // Handle error or return an appropriate response/view
            return view('error'); // Ensure you have an error view
        }
    }
}
