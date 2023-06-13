<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requeriment extends Model
{
    use HasFactory;

    protected $table = 'requeriments';

    protected $fillable = [
        'oficio_num',
        'destinatario',
        'office',
        'subject',
        'description',
        'coord_1',
        'coord_office_1',
        'coord_2',
        'coord_office_2',
        'coord_3',
        'coord_office_3',
    ];
}
