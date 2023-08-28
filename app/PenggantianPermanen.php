<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggantianPermanen extends Model
{
    protected $table = 'penggantian_permanens';
    protected $primaryKey = 'id_penggantianpermanen';
    
    protected $fillable = [
        'tgl_penggantianpermanen',
        'id_kontraksewa',
        'no_polisi_sebelumnya',
        'no_polisi_pengganti',
        'approval',
        'keterangan',
    ];

    // public function kontraksewa()
    // {
    //     return $this->belongsTo(KontrakSewa::class, 'id_kontraksewa', 'id_kontraksewa');
    // }
}
