<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

abstract class Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    // Deklarasi method-method abstract
    abstract public function index();
    abstract public function create();
    abstract public function store(Request $request);
    abstract public function edit($id);
    abstract public function update(Request $request);
    abstract public function destroy($id);
}
