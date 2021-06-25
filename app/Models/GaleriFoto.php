<?php

namespace App\Models;

use Str;
use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GaleriFoto extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'galeri_foto';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = ['id_user','id_kategori','judul','judul_slug','foto','tags','tanggal','view','flag_active','keterangan'];

    function getGetStatusAttribute()
    {
        if($this->flag_active==0)
            return '<button class="btn btn-xs btn-warning">Draft</button>';
        elseif($this->flag_active==1)
            return '<button class="btn btn-xs btn-success">Aktif</button>';
    }
    function getGetDescAttribute()
    {
        $desc = str_replace(array('&nbsp;'),'',strip_tags($this->keterangan));
        return Str::limit($desc, 50, '[...]');
    }

    function getTglPostingAttribute()
    {
        return $this->tanggal ? '<span class="label label-success"><i class="fa fa-calendar"></i> '.DateHelper::tglIndSingkat($this->tanggal).'</span>' : '';
    }

    function getGaleriFotoAttribute()
    {
        return "<img src='".url('show-image/galeri-foto/'.$this->foto)."' style='width:200px !important;'> ";
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
