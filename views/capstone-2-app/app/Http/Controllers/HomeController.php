<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Pastikan file view dashboard.blade.php ada di folder resources/views
    }
}

