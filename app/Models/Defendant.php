<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defendant extends Model
{
    use HasFactory;

    protected $table = 'defendants';

    protected $fillable = [
        'defendant',
        'cnpj',
        'judicial_collective_id',
        'administrative_collective_id',
        'judicial_individual_id',
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
}
