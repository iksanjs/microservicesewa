<?php

namespace App\Http\Controllers;

use App\Penggantian;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class PenggantianController extends Controller
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
      $penggantians = Penggantian::all();
      return response()->json($penggantians);
    }
    public function create(Request $request)
    {
        // Validasi input dari form
        $validatedData = $this->validate($request, [
            'tgl_penggantian' => 'required|date',
            'id_kontraksewa' => 'required',
            'no_polisi_sebelumnya' => 'required',
            'no_polisi_pengganti' => 'required',
        ]);

        // Simpan data penggantian permanen ke database
        $penggantian = new Penggantian();
        $penggantian->tgl_penggantian = $request->tgl_penggantian;
        $penggantian->id_kontraksewa = $request->id_kontraksewa;
        $penggantian->no_polisi_sebelumnya = $request->no_polisi_sebelumnya;
        $penggantian->no_polisi_pengganti = $request->no_polisi_pengganti;
        $penggantian->approval = 'Proses Approval';
        $penggantian->save();

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'Penggantian permanen created successfully',
            'redirect_url' => 'http://localhost:8001/penggantian' // Ganti dengan URL halaman frontend
        ], 201);

    }

    public function show($id_penggantian)
    {
       $penggantian = Penggantian::find($id_penggantian);
       return response()->json($penggantian);
    }

    public function update(Request $request, $id_penggantian)
    {
        // Validasi input dari form
        $validatedData = $this->validate($request, [
            'tgl_penggantian' => 'required|date',
            'id_kontraksewa' => 'required',
            'no_polisi_sebelumnya' => 'required',
            'no_polisi_pengganti' => 'required',
        ]);

        // Temukan penggantian permanen berdasarkan ID
        $penggantian = Penggantian::findOrFail($id_penggantian);

        // Update data penggantian permanen
        $penggantian->tgl_penggantian = $request->tgl_penggantian;
        $penggantian->id_kontraksewa = $request->id_kontraksewa;
        $penggantian->no_polisi_sebelumnya = $request->no_polisi_sebelumnya;
        $penggantian->no_polisi_pengganti = $request->no_polisi_pengganti;
        $penggantian->approval = 'Proses Approval';
        $penggantian->save();

        // Return respons JSON sukses
        return response()->json([
            'message' => 'Penggantian permanen updated successfully',
            'data' => $penggantian
        ], 200);
    }

}
