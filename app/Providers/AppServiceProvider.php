<?php

namespace App\Providers;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\Link;
use App\Models\User;
use App\Observers\LinkObserver;
use App\Observers\TopicObserver;
use App\Observers\ReplyObserver;
use App\Observers\UserObserver;
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
        Link::observe(LinkObserver::class);
        User::observe(UserObserver::class);
    }
}
