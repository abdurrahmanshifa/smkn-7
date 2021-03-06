<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';
    protected $table = 'sessions';

}