<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';

    protected $fillable = [
        'title',
        'judicial_collective_id',
        'administrative_collective_id',
        'judicial_individual_id',
        'administrative_individual_id',
        'user_id',
        'path',
    ];

    public function judicialCollective()
    {
        return $this->belongsTo(JudicialCollective::class, 'judicial_collective_id', 'id');
    }

    public function administrativeCollective()
    {
        return $this->belongsTo(AdministrativeCollective::class, 'administrative_collective_id', 'id');
    }

    public function judicialIndividuals()
    {
        return $this->belongsTo(JudicialIndividual::class, 'judicial_individual_id', 'id');
    }

    public function administrativeIndividuals()
    {
        return $this->belongsTo(AdministrativeIndividual::class, 'administrative_individual_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
