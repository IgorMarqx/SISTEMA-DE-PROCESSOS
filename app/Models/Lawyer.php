<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $table = 'lawyers';

    protected $fillable = [
        'user_id_1',
        'email_lawyer_1',
        'user_id_2',
        'email_lawyer_2',
        'user_id_3',
        'email_lawyer_3',
        'user_id_4',
        'email_lawyer_4',
        'judicial_collective_id',
        'judicial_individual_id',
        'administrative_collective_id',
        'administrative_individual_id',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
