<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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
}
