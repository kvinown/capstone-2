<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function  index()
    {
        try {
            $response = $this->client->request('GET', '/api/users');
            $statusCode = $response->getStatusCode();
            if ($statusCode = 200) {
                $users = json_decode($response->getBody()->getContents());
                $usersData = $users->data;
                return view('users.index', compact('usersData'));
            }
        } catch (\Exception $e) {
            return view('error')->with('error', $e->getMessage());
        }
    }

    public function create()
    {
            $responseRole = $this->client->request('GET', '/api/role');
            $statusCodeRole = $responseRole->getStatusCode();
            if ($statusCodeRole == 200) {
                $role = json_decode($responseRole->getBody()->getContents());
                $roleData = $role->data;
            }

            $responseProgramStudi = $this->client->request('GET', '/api/programStudi');
            $statusCodeProgramStudi = $responseProgramStudi->getStatusCode();
            if ($statusCodeProgramStudi == 200) {
                $programStudi = json_decode($responseProgramStudi->getBody()->getContents());
                $programStudiData = $programStudi->data;
            }
            return view('users.create', compact('programStudiData', 'roleData'));
    }

    public function store(Request $request)
    {
        try {
            $response = $this->client->request('POST', '/api/users-store', [
                'json' => $request->all()
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($statusCode >= 400) {
                // Jika terjadi kesalahan, tampilkan pesan kesalahan yang sesuai
                $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Terjadi kesalahan saat memproses permintaan';
                return redirect(route('users.create'))->with('error', $errorMessage);
            }

            if ($responseData['success']) {
                return redirect(route('users.index'))->with('success', 'Data berhasil ditambah');
            } else {
                return redirect(route('users.index'))->with('error', 'Data gagal ditambah');
            }
        } catch (\Exception $e) {
            return redirect(route('users.index'))->with('error', 'Terjadi kesalahan saat memproses permintaan');
        }
    }


    public function edit($id) {
            $responseUser = $this->client->request('GET', "/api/users-edit/{$id}");
            $users = json_decode($responseUser->getBody()->getContents());
            $usersData = $users->data;
            $responseRole = $this->client->request('GET', '/api/role');
            $statusCodeRole = $responseRole->getStatusCode();
            if ($statusCodeRole == 200) {
                $role = json_decode($responseRole->getBody()->getContents());
                $roleData = $role->data;
            }

            $responseProgramStudi = $this->client->request('GET', '/api/programStudi');
            $statusCodeProgramStudi = $responseProgramStudi->getStatusCode();
            if ($statusCodeProgramStudi == 200) {
                $programStudi = json_decode($responseProgramStudi->getBody()->getContents());
                $programStudiData = $programStudi->data;
            }

            return view('users.edit', compact('usersData', 'roleData', 'programStudiData'));
    }
    public function update(Request $request)
    {
        try {
            $response = $this->client->request('POST', '/api/users-update', [
                'json' => $request->all()
            ]);


            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($responseData['success']) {
                return redirect(route('users.index'))->with('success', 'Data berhasil diubah');
            } else {
                return redirect(route('users.index'))->with('error', 'Data gagal diubah');
            }
        }catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Contoh pemeriksaan pesan kesalahan spesifik
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('users.index'))->with('error', 'ID Program Studi sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('users.index'))->with('error', 'Data gagal diubah');
        } catch (\Exception $e) {
            return redirect(route('users.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->client->request('GEt', "/api/users-delete/{$id}");
            return redirect(route('users.index'))->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect(route('users.index'))->with('error', 'Data gagal dihapus');
        }
    }
}
