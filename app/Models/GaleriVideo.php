<?php

namespace App\Models;

use Str;
use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GaleriVideo extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'galeri_video';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = ['id_user','id_kategori','judul','judul_slug','link','tags','tanggal','view','flag_active','keterangan'];

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

    function getGaleriVideoAttribute()
    {
        list($url,$kode) = explode('v=',$this->link);
        $embed = '<iframe style="width:250px;height:auto;" src="https://www.youtube.com/embed/'.$kode.'" frameborder="0" allowfullscreen></iframe>';

        return $embed;
    }

    function getGaleriVideoStyleAttribute()
    {
        list($url,$kode) = explode('v=',$this->link);
        $embed = '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$kode.'" frameborder="0" allowfullscreen></iframe>';

        return $embed;
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
