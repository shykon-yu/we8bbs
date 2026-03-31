<?php

namespace App\Providers;

use App\Models\Reply;
use App\Models\Topic;
use App\Observers\TopicObserver;
use App\Observers\ReplyObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        Topic::observe(TopicObserver::class);
        Reply::observe(ReplyObserver::class);
    }
}
