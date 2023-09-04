<?php

namespace App\Http\Controllers;
use App\Penyewa;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class PenyewaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
      $penyewas = Penyewa::all();
      return response()->json($penyewas);
    }

    public function show($id_penyewa)
    {
       $penyewa = Penyewa::find($id_penyewa);
       return response()->json($penyewa);
    }
}
