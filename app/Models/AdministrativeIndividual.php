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
        'subject',
        'jurisdiction',
        'cause_value',
        'justice_secret',
        'free_justice',
        'tutelar',
        'priority',
        'judgmental_organ',
        'url_individuals',
        'url_noticies',
        'email_coorporative',
        'email_client',
        'qtd_update',
        'qtd_finish',
        'progress_individuals',
        'finish_individuals',
        'update_individuals',
        'action_type',
    ];


    public function attachmentAdministrativeIndividuals()
    {
        return $this->hasMany(Attachment::class, 'administrative_collective_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
