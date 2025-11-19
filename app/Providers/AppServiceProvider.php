<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Support\AdminActivityFeed;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer(['template-modern', 'layouts.dashboard'], function ($view) {
            if (!Schema::hasTable('announcements')) {
                $view->with([
                    'headerAnnouncements' => collect(),
                    'headerAnnouncementCount' => 0,
                ]);

                return;
            }

            $announcements = Announcement::query()
                ->active()
                ->published()
                ->latest('published_at')
                ->take(5)
                ->get();

            $view->with([
                'headerAnnouncements' => $announcements,
                'headerAnnouncementCount' => $announcements->count(),
            ]);
        });

        View::composer('layouts.admin', function ($view) {
            if (!Schema::hasTable('users')) {
                $view->with([
                    'adminNotifications' => collect(),
                    'adminNotificationUnread' => 0,
                ]);

                return;
            }

            $activities = AdminActivityFeed::build();

            $view->with([
                'adminNotifications' => $activities,
                'adminNotificationUnread' => $activities->where('is_new', true)->count(),
            ]);
        });
    }
}
