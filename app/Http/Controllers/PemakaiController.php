<?php

namespace App\Http\Controllers;
use App\Pemakai;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class PemakaiController extends Controller
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
      $pemakais = Pemakai::all();
      return response()->json($penyewas);
    }

    public function show($id_pemakai)
    {
       $pemakai = Pemakai::find($id_pemakai);
       return response()->json($pemakai);
    }
}
