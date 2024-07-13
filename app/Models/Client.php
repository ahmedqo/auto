<?php

namespace App\Models;

use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, HasSearch;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'identity',
        'identity_type',
        'nationality',
        'license_number',
        'gender',
        'birth_date',
        'email',
        'phone',
        'address',
    ];

    protected $searchable = [
        'first_name',
        'last_name',
        'identity',
        'identity_type',
        'nationality',
        'license_number',
        'gender',
        'birth_date',
        'email',
        'phone',
        'address',
    ];

    public function Reservations()
    {
        return $this->hasMany(Reservation::class, 'client');
    }

    public function Blacklist()
    {
        return $this->hasOne(Blacklist::class, 'client');
    }
}
