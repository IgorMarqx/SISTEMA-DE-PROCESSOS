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
        return $this->belongsTo(JudicialCollective::class, 'user_id', 'id');
    }

    public function judicialIndividual()
    {
        return $this->belongsTo(JudicialIndividual::class, 'user_id', 'id');
    }

    public function administrativeCollective()
    {
        return $this->belongsTo(AdministrativeCollective::class, 'user_id', 'id');
    }

    public function administrativeIndividual()
    {
        return $this->belongsTo(AdministrativeIndividual::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function judicialCollectives()
    {
        return $this->belongsToMany(JudicialCollective::class, 'userprocess', 'lawyer_id', 'judicial_collective_id');
    }

    public function administrativeCollectives()
    {
        return $this->belongsToMany(AdministrativeCollective::class, 'userprocess', 'lawyer_id', 'administrative_collective_id');
    }

    public function judicialIndividuals()
    {
        return $this->belongsToMany(JudicialIndividual::class, 'userprocess', 'lawyer_id', 'judicial_individual_id');
    }

    public function administrativeIndividuals()
    {
        return $this->belongsToMany(AdministrativeIndividual::class, 'userprocess', 'lawyer_id', 'administrative_individual_id');
    }
}
