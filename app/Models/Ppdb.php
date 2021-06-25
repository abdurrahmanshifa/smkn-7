<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppdb extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'informasi_ppdb';

    function getGetStatusAttribute()
    {
        if($this->is_active==0)
            return '<button class="btn btn-xs btn-danger">Tidak Aktif</button>';
        elseif($this->is_active==1)
            return '<button class="btn btn-xs btn-success">Aktif</button>';
    }
}