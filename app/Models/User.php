<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        self::created(function (User $user) {});
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getUserRole() {
        return $this->roles();
    }


    public function vendedor()
    {
        $cliente = ClienteVendedor::where('cliente_id', $this->id)->first();
        if (null !== $cliente) {
            $cliente->refresh();
            $vendedor = User::where('id', $cliente->vendedor_id)->first();
            $vendedor->refresh();
            echo "<a target='_blank' href='" . route('users.show', $vendedor->id) . "' >" . $vendedor->name . "</a>";
        } else {
            echo '-';
        }
    }
    public function isAdmin()
    {
        return auth()->user()->getUserRole()->get()[0]->id == 1;
    }
}
