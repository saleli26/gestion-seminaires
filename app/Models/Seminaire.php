<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'date_presentation',
        'resume',
        'statut',
        'user_id',
    ];

    // Si tu as des relations, tu peux les définir ici
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}

