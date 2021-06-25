<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'siswa';

    function jnskelamin()
    {
        return $this->belongsTo('App\Models\JnsKelamin','jenis_kelamin');
    }
}