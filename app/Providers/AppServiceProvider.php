<?php

namespace App\Providers;

use App\BlogPost;
use App\Comment;
use App\Http\ViewComposers\ActivityComposer;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use App\Services\Counter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\BadgeMessage;
use App\View\Components\UpdatedComponent;
use App\View\Components\CardComponent;
use App\View\Components\CommentForm;
use App\View\Components\ErrorsComponent;
use App\View\Components\TagsComponent;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        Blade::component('badge', BadgeMessage::class);
        Blade::component('updated', UpdatedComponent::class);
        Blade::component('card', CardComponent::class);
        Blade::component('tags', TagsComponent::class);
        Blade::component('errors', ErrorsComponent::class);
        Blade::component('comment-form', CommentForm::class);

        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);

        BlogPost::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);
        $this->app->singleton(Counter::class, function($app){
            return new Counter(
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('COUNTER_TIMEOUT')
            );
        });

        $this->app->bind(
            'App\Contracts\CounterContract',
            Counter::class
        );

        // $this->app->when(Counter::class)
        //     ->needs('$timeout')
        //     ->give(env('COUNTER_TIMEOUT'));
    }
}
