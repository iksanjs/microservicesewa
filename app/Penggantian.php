<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggantian extends Model
{
    protected $table = 'penggantians';
    protected $primaryKey = 'id_penggantian';
    
    protected $fillable = [
        'tgl_penggantian',
        'id_kontraksewa',
        'jenis_penggantian',
        'no_polisi_sebelumnya',
        'no_polisi_pengganti',
        'status',
        'approval',
        'keterangan',
    ];

    // public function kontraksewa()
    // {
    //     return $this->belongsTo(KontrakSewa::class, 'id_kontraksewa', 'id_kontraksewa');
    // }
}
