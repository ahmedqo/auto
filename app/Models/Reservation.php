<?php

namespace App\Models;

use App\Functions\Core;
use App\Traits\HasSearch;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory, HasSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client',
        'vehicle',
        'secondary_client',
        'from',
        'pick_up',
        'drop_off',
        'to',
        'period',
        'price',
        'total',
        'payment',
        'state',
        'status',
        'company',
        'starting_mileage',
        'return_mileage',
        'fuel',
    ];

    protected $searchable = [
        'client.first_name',
        'client.last_name',
        'client.identity',
        'client.nationality',
        'client.license_number',
        'client.birth_date',
        'client.email',
        'client.phone',
        'client.address',

        'sclient.first_name',
        'sclient.last_name',
        'sclient.identity',
        'sclient.nationality',
        'sclient.license_number',
        'sclient.birth_date',
        'sclient.email',
        'sclient.phone',
        'sclient.address',

        'vehicle.registration',
        'vehicle.circulation',
        'vehicle.horsepower',
        'vehicle.brand',
        'vehicle.model',
        'vehicle.year',

        'from',
        'pick_up',
        'drop_off',
        'to',
        'period',
        'price',
        'total',
        'status',
        'starting_mileage',
        'return_mileage',
        'fuel',
    ];

    protected static function booted()
    {
        self::saving(function ($Self) {
            $Self->ref =  Carbon::parse($Self->created_at)->format('Y-m') . $Self->id;
            if (is_null($Self->company)) {
                $Self->company = Core::company()->id;
            }
        });
    }

    public function Company()
    {
        return $this->hasOne(Company::class, 'id');
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client');
    }

    public function SClient()
    {
        return $this->belongsTo(Client::class, 'secondary_client');
    }

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }
}
