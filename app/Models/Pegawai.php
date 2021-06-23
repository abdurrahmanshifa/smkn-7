<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory,SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'pegawai';

    function agama()
    {
        return $this->belongsTo('App\Models\Agama','agama');
    }

    function pendidikan()
    {
        return $this->belongsTo('App\Models\Pendidikan','pend_terakhir');
    }

    function Datajabatan()
    {
        return $this->belongsTo('App\Models\Jabatan','jabatan');
    }

    function jnskelamin()
    {
        return $this->belongsTo('App\Models\JnsKelamin','jns_kelamin');
    }

    function getGetDatastatusAttribute()
    {
        if($this->status == 1)
            return '<span class="label label-success">Aktif</span>';
        else
            return '<span class="label label-danger">Tidak Aktif</span>';
    }
    function getGetFotoAttribute()
    {
        if($this->foto)
            return '<img src="'.asset('storage/pegawai/'.$this->foto).'" style="width:228px;height:171px">';
        else
            return '';
    }

    function getGetDatajabatanAttribute()
    {
        if(isset($this->datajabatan->name))
            return '<span class="label label-info"><i class="fa fa-users"></i> '.$this->datajabatan->name.'</span>';
        else
            return '<span class="label label-danger"><i class="fa fa-users"></i> - </span>';
    }

}