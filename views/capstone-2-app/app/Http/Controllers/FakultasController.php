<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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

    public function edit($id){
        try {
            $responseFakultas = $this->client->request('GET', "/api/fakultas-edit/{$id}");
            $fakultas= json_decode($responseFakultas->getBody()->getContents());
            $fakultasData = $fakultas->data;

            return view('fakultas.edit', compact('fakultasData'));
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
            $response = $this->client->request('POST', '/api/fakultas-update', [
                'json' => $request->all()
            ]);


            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($responseData['success']) {
                return redirect(route('fakutas.index'))->with('success', 'Data berhasil diubah');
            } else {
                return redirect(route('fakultas.index'))->with('error', 'Data gagal diubah');
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Contoh pemeriksaan pesan kesalahan spesifik
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('fakultas.index'))->with('error', 'ID Fakultas sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('fakultas.index'))->with('error', 'Data gagal diubah');
        } catch (\Exception $e) {
            return redirect(route('fakultas.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $response = $this->client->request('GEt', "/api/fakultas-delete/{$id}");
            return redirect(route('fakultas.index'))->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect(route('fakultas.index'))->with('error', 'Data gagal dihapus');
        }
    }
}
