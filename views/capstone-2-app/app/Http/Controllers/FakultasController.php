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
        } else {
            // Handle error or return an appropriate response/view
            return view('error'); // Ensure you have an error view
        }
    }
}
