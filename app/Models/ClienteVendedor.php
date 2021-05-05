<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteVendedor extends Model
{
    use HasFactory;
    protected $table = 'cliente_vendedor';

    public $incrementing = true;

}
