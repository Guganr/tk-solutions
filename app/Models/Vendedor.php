<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends User
{
    use HasFactory;

    public function vendedor() {
        return $this->belongsToMany(ClienteVendedor::class);
    }
}
