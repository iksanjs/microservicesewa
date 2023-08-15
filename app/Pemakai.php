<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Pemakai extends Model
{
   protected $table = 'pemakais';
   protected $primaryKey = 'id_pemakai';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['nama', 'jabatan', 'no_hp', 'status', 'id_penyewa'];

}