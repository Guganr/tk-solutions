<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends User
{
    use HasFactory;

    public function cliente() {
        return $this->belongsToOne(ClienteVendedor::class);
    }
}
