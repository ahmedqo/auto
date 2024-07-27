<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
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
        'ice',
        'license',
        'address',
        'city',
        'zipcode',
        'period',
        'mileage',
    ];

    protected static function booted()
    {
        self::created(function ($Self) {
            Image::$FILE = request('company_logo');
            $Self->Image()->create();
        });

        self::deleted(function ($Self) {
            Storage::disk('public')->delete(implode('/', [Image::$STORAGE, $Self->Image->storage]));
            $Self->Image->delete();
        });
    }

    public function Image(): MorphOne
    {
        return $this->morphOne(Image::class, 'target');
    }

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
