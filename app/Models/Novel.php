<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'author',
        'is_done',
        'user_id',
        'series_id'
    ];

    /* Relation */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}