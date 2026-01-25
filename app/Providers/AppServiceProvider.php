<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Post::class, \App\Policies\PostPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Comment::class, \App\Policies\CommentPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Test::class, \App\Policies\TestPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\LifeSection::class, \App\Policies\LifeSectionPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Work::class, \App\Policies\WorkPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Path::class, \App\Policies\PathPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Study::class, \App\Policies\StudyPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Quote::class, \App\Policies\QuotePolicy::class);
    }
}
