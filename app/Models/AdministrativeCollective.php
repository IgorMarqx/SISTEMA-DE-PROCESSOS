<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeCollective extends Model
{
    use HasFactory;

    protected $table = 'administrative_collectives';

    protected $fillable = [
        'name',
        'user_id',
        'url_collective',
        'email_coorporative',
        'email_client',
        'qtd_update',
        'qtd_finish',
        'progress_collective',
        'finish_collective',
        'update_collective',
    ];

    public function attachmentAdministrativeCollective()
    {
        return $this->hasMany(Attachment::class, 'administrative_collective_id', 'id');
    }
}
