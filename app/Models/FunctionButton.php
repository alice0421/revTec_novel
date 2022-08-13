<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionButton extends Model
{
    use HasFactory;

    /* Relation */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
