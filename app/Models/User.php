<?php

namespace App\Models;

use App\Functions\Core;
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
        'company',
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

    protected static function booted()
    {
        self::saving(function ($Self) {
            if (is_null($Self->company)) {
                $Self->company = Core::company()->id;
            }
        });
    }

    public function Company()
    {
        return $this->hasOne(Company::class, 'id');
    }
}
