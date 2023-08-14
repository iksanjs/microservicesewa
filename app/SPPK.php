<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class SPPK extends Model
{
   protected $table = 'sppks';
   protected $primaryKey = 'id_sppk';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['tgl_sppk', 'nama_pt', 'nama_cabang', 'alamat',
    'kategori', 'merk', 'tipe', 'tahun', 'warna',
    'nama', 'no_hp', 'jabatan',
    'tgl_awal', 'tgl_akhir', 'biaya_sewa', 'keterangan', 'status', 'approval']; 

}