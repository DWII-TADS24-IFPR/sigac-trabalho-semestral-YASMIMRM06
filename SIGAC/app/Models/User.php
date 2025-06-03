<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'curso_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function isStudent()
    {
        return $this->role_id === 2;
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function approvedActivities()
    {
        return $this->activities()->where('status', 'approved');
    }
}