<?php
namespace App\Http\Controllers;
use App\STWahanatoCabang;
use App\KontrakSewa;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class STWahanatoCabangController extends Controller
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
      $stwahanatocabangs = STWahanatoCabang::all();
      return response()->json($stwahanatocabangs);
    }

    public function create(Request $request)
    {
        // Lakukan validasi input
        $validatedData = $this->validate($request, [
                'no_polisi' => 'required',
                'id_penyewa' => 'required',
                'id_pemakai' => 'required',
                'id_kontraksewa' => 'required',
                'tgl_st' => 'required',
                'nama_penyerah' => 'required',
                'nama_penerima' => 'required',
        ]);
        STWahanatoCabang::create([
            'no_polisi' => $request->no_polisi,
            'id_penyewa' => $request->id_penyewa,
            'id_pemakai' => $request->id_pemakai,
            'id_kontraksewa' => $request->id_kontraksewa,
            'tgl_st' => $request->tgl_st,
            'nama_penyerah' => $request->nama_penyerah,
            'nama_penerima' => $request->nama_penerima,
            'status' => 'Proses Approval',
            'approval' => 'Proses Approval'
            ]);

        $kontraksewa = KontrakSewa::where('id_kontraksewa', $request->id_kontraksewa)->first();
        $kontraksewa->status = 'Proses Serah Terima';
        $kontraksewa->save();

        $client = new Client();

        $url = env("LUMEN_API_URL_KENDARAAN") . "/api/kendaraan/kendaraans/$request->no_polisi/updatestatusprosesst"; // Ganti dengan URL Lumen yang sesuai
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
            'message' => 'Serah terima Wahana to Cabang created successfully',
            'redirect_url' => 'http://localhost:8001/kontraksewas' // Ganti dengan URL halaman frontend
        ], 201);
   }

    public function show($id_stwahanatocabang)
    {
       $stwahanatocabang = STWahanatoCabang::find($id_stwahanatocabang);
       return response()->json($stwahanatocabang);
    }

    public function proses_serahterima()
    {
        $stwahanatocabangs = STWahanatoCabang::where('Approval', 'Proses Approval')->get();
        return response()->json($stwahanatocabangs);
    }

    public function update(Request $request, $id_stwahanatocabang)
    {
        // Lakukan validasi input
        $validatedData = $this->validate($request, [
            'no_polisi' => 'required',
            'id_penyewa' => 'required',
            'id_pemakai' => 'required',
            'id_kontraksewa' => 'required',
            'tgl_st' => 'required',
            'nama_penyerah' => 'required',
            'nama_penerima' => 'required',
        ]);
        $stwahanatocabang = STWahanatoCabang::where('id_stwahanatocabang', $id_stwahanatocabang)->first();
        $stwahanatocabang->tgl_st = $request->tgl_st;
        $stwahanatocabang->nama_penyerah = $request->nama_penyerah;
        $stwahanatocabang->nama_penerima = $request->nama_penerima;
        $stwahanatocabang->approval = 'Proses Approval';
        $stwahanatocabang->status = 'Proses Approval';
        $stwahanatocabang->save();

        $kontraksewa = KontrakSewa::where('id_kontraksewa', $request->id_kontraksewa)->first();
        $kontraksewa->status = 'Proses Serah Terima';
        $kontraksewa->save();

        $client = new Client();

        $url = env("LUMEN_API_URL_KENDARAAN") . "/api/kendaraan/kendaraans/$request->no_polisi/updatestatusprosesst"; // Ganti dengan URL Lumen yang sesuai
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
        return response()->json($stwahanatocabang);
    }

    public function approved(Request $request, $id_stwahanatocabang)
    {
        $stwahanatocabang = STWahanatoCabang::where('id_stwahanatocabang', $id_stwahanatocabang)->first();
        $kontraksewa = KontrakSewa::where('id_kontraksewa', $stwahanatocabang->id_kontraksewa)->first();
        $stwahanatocabang->approval = 'Approved';
        $stwahanatocabang->status = 'Sudah Serah Terima';
        $stwahanatocabang->save();

        $kontraksewa->status = 'Sewa Berjalan';
        $kontraksewa->save();

        $client = new Client();

        $url = env("LUMEN_API_URL_KENDARAAN") . "/api/kendaraan/kendaraans/$stwahanatocabang->no_polisi/updatestatusdisewa"; // Ganti dengan URL Lumen yang sesuai
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
        return response()->json($stwahanatocabang);
    }

    public function rejected(Request $request, $id_stwahanatocabang)
    {
        $stwahanatocabang = STWahanatoCabang::where('id_stwahanatocabang', $id_stwahanatocabang)->first();
        $kontraksewa = KontrakSewa::where('id_kontraksewa', $stwahanatocabang->id_kontraksewa)->first();
        $stwahanatocabang->approval = 'Rejected';
        $stwahanatocabang->keterangan = $request->keterangan;
        $stwahanatocabang->save();

        $kontraksewa->status = 'Serah Terima Rejected';
        $kontraksewa->save();

        $client = new Client();

        $url = env("LUMEN_API_URL_KENDARAAN") . "/api/kendaraan/kendaraans/$stwahanatocabang->no_polisi/updatestatusstreject"; // Ganti dengan URL Lumen yang sesuai
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
        return response()->json($stwahanatocabang);
    }
}