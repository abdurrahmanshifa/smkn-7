<?php

namespace App\Models;

use Str;
use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='komentar';

    function artikel()
    {
        return $this->belongsTo('App\Models\Artikel','id_artikel');
    }
    
    function user()
    {
        return $this->belongsTo('App\Models\User','id_user');
    }
    
    function balasan()
    {
        return $this->hasMany('App\Models\KomentarBalasan','id_komentar','id');
    }

    function getGetUserAttribute()
    {
        if(isset($this->user->name))
            return '<span class="label label-info"><i class="fa fa-user"></i> '.$this->user->name.'</span>';
        else
            return '';
    }
    function getGetStatusAttribute()
    {
        if($this->flag_active==0)
            return '<button class="btn btn-xs btn-warning">Draft</button>';
        elseif($this->flag_active==1)
            return '<button class="btn btn-xs btn-success">Aktif</button>';
    }
    function getGetBalasanAttribute()
    {
        if($this->balasan->count()!=0)
            return '<span class="label label-success">Sudah Di Balas</span>';
        else
            return '<span class="label label-danger">Belum Di Balas</span>';
    }

    function getGetArtikelAttribute()
    {
        if(isset($this->artikel->judul))
            return '<b>'.$this->artikel->judul.'</b>';
        else
            return '';
    }
function getGetDescAttribute()
    {
        $desc = str_replace(array('&nbsp;'),'',strip_tags($this->isi_komentar));
        return Str::limit($desc, 50, '[...]');
    }

    function getTglPostingAttribute()
    {
        return $this->tanggal ? '<span class="label label-success"><i class="fa fa-calendar"></i> '.DateHelper::tglIndSingkat($this->tanggal).'</span>' : '';
    }
}
