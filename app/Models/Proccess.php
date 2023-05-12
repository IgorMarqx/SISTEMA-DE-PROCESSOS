<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'url_proccess',
        'email_coorporative',
        'email_client',
        'qtd_update',
        'qtd_finish',
        'reopen_proccess',
        'progress_proccess',
    ];
}
