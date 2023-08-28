<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class STWahanatoCabang extends Model
{
    protected $table = 's_t_wahanato_cabangs';
    protected $primaryKey = 'id_stwahanatocabang';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['tgl_st', 'nama_penyerah', 'nama_penerima', 'no_polisi', 'id_penyewa', 'id_pemakai', 'id_kontraksewa', 'status', 'keterangan', 'approval'];
}
