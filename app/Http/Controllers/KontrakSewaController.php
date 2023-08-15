<?php
namespace App\Http\Controllers;
use App\KontrakSewa;
use App\Penyewa;
use App\Pemakai;
use App\SPPK;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class KontrakSewaController extends Controller
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
      $kontraksewas = KontrakSewa::all();
      return response()->json($kontraksewas);
    }

    public function create(Request $request)
    {
      // Lakukan validasi input
      $validatedData = $this->validate($request, [
            'no_polisi' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'tgl_sewa' => 'required',
            'biaya_sewa' => 'required',
            'id_sppk' => 'required',
            'nama_pt' => 'required',
            'nama_cabang' => 'required',
            'alamat' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
      ]);

      // Cari atau buat data penyewa berdasarkan nama_pt dan nama_cabang
    $penyewa = Penyewa::firstOrCreate([
        'nama_pt' => $request->nama_pt,
        'nama_cabang' => $request->nama_cabang
    ], [
        'alamat' => $request->alamat,
        'status' => 'Proses Approval'
    ]);

    // Cari atau buat data pemakai berdasarkan nama dan jabatan
    $pemakai = Pemakai::firstOrCreate(
        ['nama' => $request->nama, 'jabatan' => $request->jabatan],
        [
            'no_hp' => $request->no_hp,
            'id_penyewa' => $penyewa->id_penyewa,
            'status' => 'Proses Approval'
        ]
    );

    // Buat KontrakSewa baru dan simpan ke database dengan menggunakan id penyewa dan pemakai yang telah dibuat
    $kontrakSewa = KontrakSewa::create([
        'no_polisi' => $request->no_polisi,
        'tgl_awal' => $request->tgl_awal,
        'tgl_akhir' => $request->tgl_akhir,
        'tgl_sewa' => $request->tgl_sewa,
        'biaya_sewa' => $request->biaya_sewa,
        'id_penyewa' => $penyewa->id_penyewa,
        'id_pemakai' => $pemakai->id_pemakai,
        'id_sppk' => $request->id_sppk,
        'status' => 'Proses Approval',
        'approval' => 'Proses Approval'
    ]);

    $client = new Client();

    $url = "http://localhost:8006/api/kendaraan/kendaraans/$request->no_polisi/updatestatusproses"; // Ganti dengan URL Lumen yang sesuai
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

    $sppks = SPPK::where('id_sppk', $request->id_sppk)->first();
    $sppks->status = 'Sudah Kontrak Sewa';
    $sppks->save();

      // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
      return response()->json([
         'message' => 'kontrak Sewa created successfully',
         'redirect_url' => 'http://localhost:8001/kontraksewas' // Ganti dengan URL halaman frontend
      ], 201);
   }

   public function show($id_kontraksewa)
    {
       $kontraksewas = KontrakSewa::find($id_kontraksewa);
       return response()->json($kontraksewas);
    }

    public function edit($id_kontraksewa)
    {
        //
    }

    public function approved($id_kontraksewa)
    {
        $kontraksewa = KontrakSewa::where('id_kontraksewa', $id_kontraksewa)->first();
        $penyewa = Penyewa::where('id_penyewa', $kontraksewa->id_penyewa)->first();
        $pemakai = Pemakai::where('id_pemakai', $kontraksewa->id_pemakai)->first();
        $client = new Client();
        $url = "http://localhost:8006/api/kendaraan/kendaraans/$kontraksewa->no_polisi/updatestatusdisewa"; // Ganti dengan URL Lumen yang sesuai
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
        $kontraksewa->approval = 'Approved';
        $kontraksewa->save();
        $penyewa->status = 'Sudah Kontrak Sewa';
        $penyewa->save();
        $pemakai->status = 'Sudah Kontrak Sewa';
        $penyewa->save();

        return response()->json($kontraksewa);
    }

    public function rejected(Request $request, $id_kontraksewa)
    {
        $kontraksewa = KontrakSewa::where('id_kontraksewa', $id_kontraksewa)->first();
        $penyewa = Penyewa::where('id_penyewa', $kontraksewa->id_penyewa)->first();
        $pemakai = Pemakai::where('id_pemakai', $kontraksewa->id_pemakai)->first();

        $kontraksewa->approval = 'Reject';
        $kontraksewa->status = 'Reject';
        $kontraksewa->keterangan = $request->keterangan;
        $kontraksewa->save();
        $penyewa->status = 'Reject';
        $penyewa->save();
        $pemakai->status = 'Reject';
        $pemakai->save();

        return response()->json($kontraksewa);
    }

}