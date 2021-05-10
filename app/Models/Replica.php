<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replica extends Model
{
    use HasFactory;
    protected  $primaryKey = 'id';
    protected $fillable = [
        'mensagem',
        'responsavel',
        'ticket_id',
    ];
    public function tickets()
    {
        return $this->hasOne(Ticket::class);
    }
    public function responsavel()
    {
        $user = User::where('id', $this->responsavel)->first();
        if (null !== $user) {
            $user->refresh();
            return $user->name;
        } else {
            return '-';
        }
    }
}
