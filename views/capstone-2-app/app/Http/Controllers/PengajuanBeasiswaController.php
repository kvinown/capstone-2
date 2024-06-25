<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanBeasiswaController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/pengajuanBeasiswa');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $pengajuanBeasiswa = json_decode($response->getBody()->getContents());
            $pengajuanBeasiswaData = $pengajuanBeasiswa->data;
            return view('pengajuan.index', compact('pengajuanBeasiswaData'));
        }
    }

    public function detail($users_id, $jenisBeasiswa_id, $periodeBeasiswa_id, $ipk, $point_portofolio)
    {
        $respone = $this->client->request('GET', "/api/dokumenPengajuan-detail/$users_id/$jenisBeasiswa_id/$periodeBeasiswa_id/$ipk/$point_portofolio");
        $responeData = json_decode($respone->getBody()->getContents());
        $data  = $responeData->data;

        return view('pengajuan.index-detail', compact('data'));
    }


    public function create()
    {
        try {
            $response = $this->client->request('GET', '/api/periode');
            $responseJenis = $this->client->request('GET', '/api/jenisBeasiswa');
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $periodeBeasiswa = json_decode($response->getBody()->getContents());
                $periodeBeasiswaData = $periodeBeasiswa->data;
                $jenisBeasiswa = json_decode($responseJenis->getBody()->getContents());
                $jenisBeasiswaData = $jenisBeasiswa->data;
                return view('pengajuan.create', compact('periodeBeasiswaData','jenisBeasiswaData'));
            }
        } catch (\Exception $e) {
            return view('error', ['message' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'user_id' => auth()->id(),
            'periodeBeasiswa_id' => $request->periodeBeasiswa_id,
            'jenisBeasiswa_id' => $request->jenisBeasiswa_id,
            'ipk' => $request->ipk,
            'point_portofolio' => $request->point_portofolio,
        ];
        $response = $this->client->request('POST', '/api/pengajuanBeasiswa-store', [
            'json' => $data
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);
        if ($responseData['success']) {
            return redirect()->route('dokumenBeasiswa.create', $data)->with('success', 'Data berhasil ditambah');
        } else {
            return redirect()->route('pengajuanBeasiswa.index')->with('error', 'Data gagal ditambah');
        }
    }

    public function approveProdi($id)
    {
        try {
            $responseBeasiswa = $this->client->request('GET', "/api/pengajuanBeasiswa-edit/{$id}");
            $beasiswa= json_decode($responseBeasiswa ->getBody()->getContents());
            $beasiswaData = $beasiswa->data;
//            dd($beasiswaData->statusProdiApproved);
            return view('pengajuan.approveProdi', compact('beasiswaData'));
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

    public function approveFakultas($id)
    {
        try {
            $responseBeasiswa = $this->client->request('GET', "/api/pengajuanBeasiswa-edit/{$id}");
            $beasiswa= json_decode($responseBeasiswa ->getBody()->getContents());
            $beasiswaData = $beasiswa->data;
//            dd($beasiswaData->statusProdiApproved);
            return view('pengajuan.approveFakultas', compact('beasiswaData'));
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
            $response = $this->client->request('POST', '/api/pengajuanBeasiswa-update', [
                'json' => $request->all()
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($responseData['success']) {
                return redirect(route('pengajuanBeasiswa.index'))->with('success', 'Data berhasil diubah');
            } else {
                return redirect(route('pengajuanBeasiswa.index'))->with('error', 'Data gagal diubah');
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Contoh pemeriksaan pesan kesalahan spesifik
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('pengajuanBeasiswa.index'))->with('error', 'ID Pengajuan Beasiswa sudah terdaftar, silahkan diganti dengan ID yang lain');
            }

            return redirect(route('pengajuanBeasiswa.index'))->with('error', 'Data gagal diubah');
        } catch (\Exception $e) {
            return redirect(route('pengajuanBeasiswa.index'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
}
