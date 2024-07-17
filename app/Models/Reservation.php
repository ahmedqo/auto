<?php

namespace App\Models;

use App\Traits\HasSearch;
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
        'from',
        'pick_up',
        'drop_off',
        'to',
        'period',
        'price',
        'total',
        'payment',
        'status',
        'insurance'
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

        'vehicle.name_en',
        'from',
        'pick_up',
        'drop_off',
        'to',
        'period',
        'price',
        'total',
        'status',
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client');
    }

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }
}
