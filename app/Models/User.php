<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'organ',
        'office',
        'capacity',
        'telephone',
        'cpf',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function judicialCollective()
    {
        return $this->hasMany(JudicialCollective::class, 'user_id', 'id');
    }

    public function judicialIndividual()
    {
        return $this->hasMany(JudicialIndividual::class, 'user_id', 'id');
    }

    public function administrativeCollective()
    {
        return $this->hasMany(AdministrativeCollective::class, 'user_id', 'id');
    }

    public function administrativeIndividual()
    {
        return $this->hasMany(AdministrativeIndividual::class, 'user_id', 'id');
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class, 'user_id', 'id');
    }

    public function lawyers()
    {
        return $this->hasMany(Lawyer::class, 'user_id_1', 'id');
    }
    public function lawyers2()
    {
        return $this->hasMany(Lawyer::class, 'user_id_2', 'id');
    }
    public function lawyers3()
    {
        return $this->hasMany(Lawyer::class, 'user_id_3', 'id');
    }
    public function lawyers4()
    {
        return $this->hasMany(Lawyer::class, 'user_id_4', 'id');
    }
}
