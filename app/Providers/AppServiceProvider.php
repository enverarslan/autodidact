<?php

namespace App\Providers;

use App\Http\Controllers\TopicController;
use App\Models\Topic;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('topics.composers.latest_topics_list', function ($view) {
            $view->with('latest_topics', Topic::getLatestTopicList(session('latest_topics_page', 1)));
        });
    }
}
