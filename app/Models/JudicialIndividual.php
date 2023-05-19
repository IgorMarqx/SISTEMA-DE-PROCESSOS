<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudicialIndividual extends Model
{
    use HasFactory;

    protected $table = 'judicial_individuals';

    protected $fillable = [
        'name',
        'user_id',
        'url_individuals',
        'email_coorporative',
        'email_client',
        'qtd_update',
        'qtd_finish',
        'progress_individuals',
        'finish_individuals',
        'update_individuals',
    ];


    public function attachmentJudicialIndividuals()
    {
        return $this->hasMany(Attachment::class, 'judicial_collective_id', 'id');
    }
}
