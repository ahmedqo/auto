<?php

namespace App\Models;

use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'email',
        'phone',
        'address',
        'password',
    ];

    protected $searchable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'email',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    // protected static function booted()
    // {
    //     self::creating(function ($data) {
    //         $data->gender = "female";
    //     });
    // }
}
