<?php

namespace App\Models;

use App\Functions\Core;
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
        'identity_location',
        'identity_date',
        'nationality',
        'license_number',
        'license_location',
        'license_date',
        'gender',
        'birth_date',
        'email',
        'phone',
        'address',
        'company',
    ];

    protected $searchable = [
        'first_name',
        'last_name',
        'identity',
        'identity_type',
        'identity_location',
        'identity_date',
        'nationality',
        'license_number',
        'license_location',
        'license_date',
        'gender',
        'birth_date',
        'email',
        'phone',
        'address',
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

    public function Reservations()
    {
        return $this->hasMany(Reservation::class, 'client');
    }

    public function Blacklist()
    {
        return $this->hasOne(Blacklist::class, 'client');
    }
}
