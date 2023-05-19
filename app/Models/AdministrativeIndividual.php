<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeIndividual extends Model
{
    use HasFactory;

    protected $table = 'administrative_individuals';

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


    public function attachmentAdministrativeIndividuals()
    {
        return $this->hasMany(Attachment::class, 'administrative_collective_id', 'id');
    }
}
