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
        'user_id',
        'output_setting_template_id',
    ];

    /* Relation */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}