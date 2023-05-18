<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    use HasFactory;

    protected $table = 'individuals';

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
}
