<?php
namespace App\Http\Controllers;
use App\Pengembalian;
use App\KontrakSewa;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class PengembalianController extends Controller
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
      $pengembalians = Pengembalian::all();
      return response()->json($pengembalians);
    }

    public function create(Request $request)
    {
        // Lakukan validasi input
        $validatedData = $this->validate($request, [
                'id_kontraksewa' => 'required',
                'tgl_pengembalian' => 'required',
                'alasan' => 'required',
        ]);

        // Buat KontrakSewa baru dan simpan ke database dengan menggunakan id penyewa dan pemakai yang telah dibuat
        $pengembalian = Pengembalian::create([
            'id_kontraksewa' => $request->id_kontraksewa,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'alasan' => $request->alasan,
            'status' => 'Proses Approval',
            'approval' => 'Proses Approval'
        ]);

        $kontraksewa = KontrakSewa::find($request->id_kontraksewa);
        $kontraksewa->status = 'Proses Pengembalian';
        $kontraksewa->save();

        $client = new Client();

        $url = "http://localhost:8006/api/kendaraan/kendaraans/$kontraksewa->no_polisi/updatestatusprosespengembalian"; // Ganti dengan URL Lumen yang sesuai
        try {
            $response = $client->put($url);

            if ($response->getStatusCode() == 200) {
                // Respons sukses, tangani sesuai kebutuhan
            } else {
                // Tangani respons error
            }
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
        }

      // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
      return response()->json([
         'message' => 'Pengembalian created successfully',
         'redirect_url' => 'http://localhost:8001/pengembalians' // Ganti dengan URL halaman frontend
      ], 201);
    }

    public function approved(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::where('id_pengembalian', $id_pengembalian)->first();
        $pengembalian->approval = 'Approved';
        $pengembalian->status = 'Sudah Pengembalian';
        $pengembalian->save();

        $kontraksewa = KontrakSewa::where('id_kontraksewa', $pengembalian->id_kontraksewa)->first();
        $kontraksewa->status = 'Selesai';
        $kontraksewa->save();

        $client = new Client();

        $url = "http://localhost:8006/api/kendaraan/kendaraans/$kontraksewa->no_polisi/updatestatusstock"; // Ganti dengan URL Lumen yang sesuai
        try {
            $response = $client->put($url);

            if ($response->getStatusCode() == 200) {
                // Respons sukses, tangani sesuai kebutuhan
            } else {
                // Tangani respons error
            }
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
        }

        // Tampilkan pesan sukses atau lakukan tindakan sesuai kebutuhan
        return response()->json($pengembalian);
    }

    public function rejected(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::where('id_pengembalian', $id_pengembalian)->first();
        $pengembalian->keterangan = $request->keterangan;
        $pengembalian->approval = 'Reject';
        $pengembalian->status = 'Reject';
        $pengembalian->save();

        // Tampilkan pesan sukses atau lakukan tindakan sesuai kebutuhan
        return response()->json($pengembalian);
    }
}