<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'period',
        'milage',
    ];

    public function Alerts()
    {
        return $this->hasMany(Alert::class, 'company');
    }

    public function Blacklist()
    {
        return $this->hasMany(Blacklist::class, 'company');
    }

    public function Charges()
    {
        return $this->hasMany(Charge::class, 'company');
    }

    public function Clients()
    {
        return $this->hasMany(Client::class, 'company');
    }

    public function Reservations()
    {
        return $this->hasMany(Reservation::class, 'company');
    }

    public function Users()
    {
        return $this->hasMany(User::class, 'company');
    }

    public function Vehicles()
    {
        return $this->hasMany(Vehicle::class, 'company');
    }
}
