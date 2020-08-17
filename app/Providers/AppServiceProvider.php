<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\BadgeMessage;
use App\View\Components\UpdatedComponent;
use App\View\Components\CardComponent;
use App\View\Components\ErrorsComponent;
use App\View\Components\TagsComponent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('badge', BadgeMessage::class);
        Blade::component('updated', UpdatedComponent::class);
        Blade::component('card', CardComponent::class);
        Blade::component('tags', TagsComponent::class);
        Blade::component('errors', ErrorsComponent::class);

        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);
    }
}
