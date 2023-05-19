<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudicialCollective extends Model
{
    use HasFactory;

    protected $table = 'judicial_collectives';

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function attachmentJudicialCollective()
    {
        return $this->hasMany(Attachment::class, 'judicial_collective_id', 'id');
    }
}
