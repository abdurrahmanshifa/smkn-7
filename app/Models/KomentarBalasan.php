<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomentarBalasan extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='komentar_balasan';
    protected $fillable = ['id_artikel','id_komentar','id_user','judul_balasan','tanggal','flag_active','isi_artikel'];

    function artikel()
    {
        return $this->belongsTo('App\Models\Artikel','id_artikel');
    }
    function komentar()
    {
        return $this->belongsTo('App\Models\Komentar','id_komentar');
    }
}
