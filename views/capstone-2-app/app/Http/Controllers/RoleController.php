<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/role');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $role = json_decode($response->getBody()->getContents());
            $roleData = $role->data;
            return view('role.index', compact('roleData'));
        }
    }
    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $response = $this->client->request('POST', '/api/role-store', [
            'json' => $request->all()
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        if ($responseData['success']) {
            return redirect(route('role.index'))->with('success', 'Data berhasil ditambah');
        } else {
            return redirect(route('role.index'))->with('error', 'Data gagal ditambah');
        }
    }

    public function edit($id){
        try {
            $responseRole = $this->client->request('GET', "/api/role-edit/{$id}");
            $role= json_decode($responseRole->getBody()->getContents());
            $roleData = $role->data;

            return view('role.edit', compact('roleData'));
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
            $response = $this->client->request('POST', '/api/role-update', [
                'json' => $request->all()
            ]);


            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($responseData['success']) {
                return redirect(route('role.index'))->with('success', 'Data berhasil diubah');
            } else {
                return redirect(route('role.index'))->with('error', 'Data gagal diubah');
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Contoh pemeriksaan pesan kesalahan spesifik
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('role.index'))->with('error', 'ID Role sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('role.index'))->with('error', 'Data gagal diubah');
        } catch (\Exception $e) {
            return redirect(route('role.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
