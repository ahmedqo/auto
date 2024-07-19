<?php

namespace App\Models;

use App\Traits\HasSearch;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as MD;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Vehicle extends MD implements Sitemapable
{
    use HasFactory, HasSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'passengers',
        'milage',
        'doors',
        'cargo',
        'transmission',
        'fuel',
        'slug',
        'name',
        'details',
    ];

    protected $searchable = [
        'price',
        'passengers',
        'milage',
        'doors',
        'cargo',
        'transmission',
        'fuel',
        'name',
        'details',
    ];

    protected static function booted()
    {
        self::created(function ($Self) {
            foreach (request('images') as $Image) {
                Image::$FILE = $Image;
                $Self->Images()->create();
            }
        });

        self::deleted(function ($Self) {
            $Self->Images->each(function ($Image) {
                Storage::disk('public')->delete(implode('/', [Image::$STORAGE, $Image->storage]));
                $Image->delete();
            });
        });
    }

    public function toSitemapTag(): Url | string | array
    {
        return Url::create(url(route('views.guest.show', $this->slug), secure: true))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.1);
    }

    public function Reservations()
    {
        return $this->hasMany(Reservation::class, 'vehicle');
    }

    public function Charges()
    {
        return $this->hasMany(Charge::class, 'vehicle');
    }

    public function Alerts()
    {
        return $this->hasMany(Alert::class, 'vehicle');
    }

    public function Images(): MorphMany
    {
        return $this->morphMany(Image::class, 'target');
    }
}
