<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $table = 'admins'; // optional but recommended

    protected $fillable = [
        'email',
        'password',
        'name', // add if name column exists
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}