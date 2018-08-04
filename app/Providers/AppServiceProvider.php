<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Common\Models\User;
use App\Common\Observers\UserObserver;
use Illuminate\Database\Schema\Blueprint;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blueprint::macro('auditable', function (?bool $create = true, ?bool $update = true) {
            $usersTableName = (new User)->getTable();

            if ($create) {
                $this->timestamp('created_at')->nullable();
                $this->unsignedInteger('created_by')->nullable()->index();
                $this->foreign('created_by')->references('id')->on($usersTableName);
            }

            if ($update) {
                $this->timestamp('updated_at')->nullable();
                $this->unsignedInteger('updated_by')->nullable()->index();
                $this->foreign('updated_by')->references('id')->on($usersTableName);
            }
        });

        Blueprint::macro('dropAuditable', function () {
            $this->dropColumn(['created_at', 'created_by', 'updated_at', 'updated_by']);
        });
    }
}
