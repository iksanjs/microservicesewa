<?php

namespace App\Http\Controllers;

use App\PenggantianPermanen;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class PenggantianPermanenController extends Controller
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
      $penggantianpermanens = PenggantianPermanen::all();
      return response()->json($penggantianpermanens);
    }
    public function create(Request $request)
    {
        // Validasi input dari form
        $validatedData = $this->validate($request, [
            'tgl_penggantianpermanen' => 'required|date',
            'id_kontraksewa' => 'required',
            'no_polisi_sebelumnya' => 'required',
            'no_polisi_pengganti' => 'required',
        ]);

        // Simpan data penggantian permanen ke database
        $penggantianPermanen = new PenggantianPermanen();
        $penggantianPermanen->tgl_penggantianpermanen = $request->tgl_penggantianpermanen;
        $penggantianPermanen->id_kontraksewa = $request->id_kontraksewa;
        $penggantianPermanen->no_polisi_sebelumnya = $request->no_polisi_sebelumnya;
        $penggantianPermanen->no_polisi_pengganti = $request->no_polisi_pengganti;
        $penggantianPermanen->approval = 'Proses Approval';
        $penggantianPermanen->save();

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'Penggantian permanen created successfully',
            'redirect_url' => 'http://localhost:8001/penggantianpermanen' // Ganti dengan URL halaman frontend
        ], 201);

    }

    public function show($id_penggantianpermanen)
    {
       $penggantianpermanen = PenggantianPermanen::find($id_penggantianpermanen);
       return response()->json($penggantianpermanen);
    }

    public function update(Request $request, $id_penggantianpermanen)
    {
        // Validasi input dari form
        $validatedData = $this->validate($request, [
            'tgl_penggantianpermanen' => 'required|date',
            'id_kontraksewa' => 'required',
            'no_polisi_sebelumnya' => 'required',
            'no_polisi_pengganti' => 'required',
        ]);

        // Temukan penggantian permanen berdasarkan ID
        $penggantianPermanen = PenggantianPermanen::findOrFail($id_penggantianpermanen);

        // Update data penggantian permanen
        $penggantianPermanen->tgl_penggantianpermanen = $request->tgl_penggantianpermanen;
        $penggantianPermanen->id_kontraksewa = $request->id_kontraksewa;
        $penggantianPermanen->no_polisi_sebelumnya = $request->no_polisi_sebelumnya;
        $penggantianPermanen->no_polisi_pengganti = $request->no_polisi_pengganti;
        $penggantianPermanen->approval = 'Proses Approval';
        $penggantianPermanen->save();

        // Return respons JSON sukses
        return response()->json([
            'message' => 'Penggantian permanen updated successfully',
            'data' => $penggantianPermanen
        ], 200);
    }

}
