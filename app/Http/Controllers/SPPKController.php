<?php
namespace App\Http\Controllers;
use App\SPPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class sppkController extends Controller
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
        
      $sppks = SPPK::all();
      return response()->json($sppks);
    }

    public function create(Request $request)
    {
      // Lakukan validasi input
      $validatedData = $this->validate($request, [
          'tgl_sppk' => 'required',
          'nama_pt' => 'required',
          'nama_cabang' => 'required',
          'alamat' => 'required',
          'kategori' => 'required',
          'merk' => 'required',
          'tipe' => 'required',
          'tahun' => 'required',
          'warna' => 'required',
          'nama' => 'required',
          'no_hp' => 'required',
          'jabatan' => 'required',
          'tgl_awal' => 'required',
          'tgl_akhir' => 'required',
          'biaya_sewa' => 'required',
      ]);

      // Simpan produk baru
      $sppk = new SPPK;
      $sppk->tgl_sppk = $request->tgl_sppk;
      $sppk->nama_pt = $request->nama_pt;
      $sppk->nama_cabang = $request->nama_cabang;
      $sppk->alamat = $request->alamat;
      $sppk->kategori = $request->kategori;
      $sppk->merk = $request->merk;
      $sppk->tipe = $request->tipe;
      $sppk->tahun = $request->tahun;
      $sppk->warna = $request->warna;
      $sppk->nama = $request->nama;
      $sppk->no_hp = $request->no_hp;
      $sppk->jabatan = $request->jabatan;
      $sppk->tgl_awal = $request->tgl_awal;
      $sppk->tgl_akhir = $request->tgl_akhir;
      $sppk->biaya_sewa = $request->biaya_sewa;
      $sppk->status = 'Proses Approval';
      $sppk->approval = 'Proses Approval';
      $sppk->save();

      // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
      return response()->json([
         'message' => 'sppk created successfully',
         'redirect_url' => 'http://localhost:8001/sppk' // Ganti dengan URL halaman frontend
      ], 201);
   }

    public function show($id_sppk)
    {
       $sppk = Sppk::find($id_sppk);
       return response()->json($sppk);
    }

    public function update(Request $request, $id_sppk)
    {
       $sppk= sppk::find($id_sppk);
      
       $sppk->name = $request->input('name');
       $sppk->price = $request->input('price');
       $sppk->description = $request->input('description');
       $sppk->save();
       return response()->json($sppk);
    }

    public function destroy($id_sppk)
    {
       $sppk = sppk::find($id_sppk);
       $sppk->delete();
       return response()->json('sppk removed successfully');
    }
 
}