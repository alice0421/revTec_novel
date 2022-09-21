<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputSettingTemplate extends Model
{
    use HasFactory;

    /* Relation */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
