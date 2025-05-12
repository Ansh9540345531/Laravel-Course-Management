<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'mobile', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
