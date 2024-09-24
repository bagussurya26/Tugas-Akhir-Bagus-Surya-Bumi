<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'real_pass',
        'nama',
        'email',
        'no_hp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role)
    {
        // Assuming your role field is an enum type
        return $this->role === $role;
    }
    
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logOnly(['title', 'slug', 'content'])
    //         ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
    //         ->useLogName('Post');
    // }

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logOnly([
    //             'id',
    //             'username',
    //             'password',
    //             'nama',
    //             'email',
    //             'no_hp',
    //             'role',
    //         ])
    //         ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
    //         // ->logOnlyDirty()
    //         ->useLogName('User');

    // }
}
