<?php

use App\Models\Blog;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Sitemap;

Artisan::command('sitemap:generate', function () {
    $sitemap = Sitemap::create()
        ->add(url(route('views.guest.index'), secure: true))
        ->add(url(route('views.guest.fleet'), secure: true))
        ->add(url(route('views.guest.blogs'), secure: true))
        ->add(url(route('views.guest.faqs'), secure: true))
        ->add(url(route('views.guest.terms'), secure: true))
        ->add(url(route('views.guest.privacy'), secure: true))
        ->add(Vehicle::all())
        ->add(Blog::all())
        ->writeToFile(public_path('sitemap.xml'));
})->purpose('generate site map');
