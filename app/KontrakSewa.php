<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class KontrakSewa extends Model
{
   protected $table = 'kontrak_sewas';
   protected $primaryKey = 'id_kontraksewa';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['tgl_sewa', 'tgl_awal', 'tgl_akhir', 'biaya_sewa', 
                        'no_polisi', 'id_penyewa', 'id_pemakai', 'id_sppk', 
                        'status', 'keterangan', 'approval']; 

}