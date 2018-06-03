<?php

namespace App\Providers;

use App\House;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin-layouts.aside', function ($view) {
            $view->with('user', auth()->user());
            $view->with('numOfHouses', \App\House::all()->count());
            $view->with('numOfFeaturedHouses', \App\House::where('featured_house', 1)->get()->count());
            $view->with('numOfUnpublishHouses', \App\House::where('is_approved', 0)->get()->count());
            $view->with('numOfPublishHouses', \App\House::where('is_approved', 1)->get()->count());
            $view->with('numOfRegion', \App\Region::all()->count());
            $view->with('numOfType', \App\HouseType::all()->count());
            $view->with('numOfFeature', \App\HouseFeature::all()->count());
            $view->with('numOfRole', \App\Role::all()->count());
            $view->with('numOfUsers', \App\User::all()->count());
            $view->with('numOfSuperAdmin', \App\Role::where('slug', 'superadmin')->first()->users()->count());
            $view->with('numOfAdmin', \App\Role::where('slug', 'admin')->first()->users()->count());
            $view->with('numOfHost', \App\Role::where('slug', 'host')->first()->users()->count());
            $view->with('numOfVistor', \App\Role::where('slug', 'guest')->first()->users()->count());
        });

        view()->composer('admin-layouts.main_header', function ($view) {
            $view->with('message', \App\GuestMessage::where('user_id', auth()->id())->first());
            $view->with('user', auth()->user());
        });

        view()->composer('layouts.topbar', function ($view) {
            $view->with('numOfContactMessage', \App\ContactMessage::all()->count());
            $view->with('numOfFavourite', \App\Favourite::where('user_id', auth()->id())->count());
        });

        view()->composer(['layouts.topbar', 'admin-layouts.main_header'], function ($view) {
            $view->with('numOfGuestMessage', \App\GuestMessage::where('user_id', auth()->id())->count());
        });

        view()->composer('*', function ($view) {
            $view->with('regions', \App\Region::all());
        });

        view()->composer('*', function ($view) {
            $view->with('types', \App\HouseType::all());
        });

        view()->composer('*', function ($view) {
            $view->with('path', asset('/storage/photos/'));
        });

        view()->composer('*', function ($view) {
            $view->with('thumbnails', asset('/storage/photos/thumbnails'));
        });

        view()->composer('homes.property.featured-widget', function ($view) {
            $view->with('featured_houses', \App\House::featuredHouse()->get());
        });


        view()->composer('homes.property.location-widget', function ($view) {
            $view->with('locations', \App\Location::groupBy('township')->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
