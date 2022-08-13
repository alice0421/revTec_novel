<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Relation */
    public function novels()   
    {
        return $this->hasMany('App\Novel');  
    }
    public function series()   
    {
        return $this->hasMany('App\Series');  
    }
    public function output_setting_templates()   
    {
        return $this->hasMany('App\OutputSettingTemplate');  
    }
    public function novel_setting_templates()   
    {
        return $this->hasMany('App\NovelSettingTemplate');  
    }
    public function shortcuts()   
    {
        return $this->hasMany('App\Shortcut');  
    }
    public function function_buttons()   
    {
        return $this->hasMany('App\FunctionButton');
    }
}
