<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProcess extends Model
{
    use HasFactory;

    protected $table = 'userprocess';

    protected $fillable = [
        'user_id',
        'lawyer_id',
        'judicial_collective_id',
        'judicial_individual_id',
        'administrative_collective_id',
        'administrative_individual_id',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }
}
