<?php

namespace App\Models;

use Str;
use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='jurusan';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    function kategori()
    {
        return $this->belongsTo('App\Models\Kategori','id_kategori');
    }

    function user()
    {
        return $this->belongsTo('App\Models\User','id_user');
    }

    function getGetStatusAttribute()
    {
        if($this->flag_active==0)
            return '<button class="btn btn-xs btn-warning">Draft</button>';
        elseif($this->flag_active==1)
            return '<button class="btn btn-xs btn-success">Aktif</button>';
    }

    function getGetKategoriAttribute()
    {
        if(isset($this->kategori->name))
            return '<span class="label label-info"><i class="fa fa-folder"></i> '.$this->kategori->name.'</span>';
        else
            return '';
    }

    function getGetCoverAttribute()
    {
        if($this->cover)
        {
            // return '<img src="'.asset('storage/blog/'.$this->cover).'" style="width:100px;" alt="'.$this->judul.'" class="img-thumbnail">';
            return '<img src="'.url('show-image/jurusan/'.$this->cover).'" style="width:100px;" alt="'.$this->judul.'" class="img-thumbnail">';
        }
        else
        {
            return '<img src="'.asset('img/no-image-available.png').'" style="width:100px;" alt="'.$this->judul.'" class="img-thumbnail">';
        }
    }

    function getGetDescAttribute()
    {
        $desc = str_replace(array('&nbsp;'),'',strip_tags($this->isi_artikel));
        return Str::limit($desc, 50, '[...]');
    }

    function getTglPostingAttribute()
    {
        return $this->tanggal ? '<span class="label label-success"><i class="fa fa-calendar"></i> '.DateHelper::tglIndSingkat($this->tanggal).'</span>' : '';
    }

    function getGetViewAttribute()
    {
        return '<span class="label label-info"><i class="fa fa-eye"></i> '.$this->view.'</span>';
    }

    function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['judul_slug'] = Str::slug($value);
    }
}
