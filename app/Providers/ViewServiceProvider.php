<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['users.create', 'users.edit'], function ($view) {
            return $view->with(
                'roles',
                Role::select('id', 'name')->get()
            );
        });
  

				View::composer(['employees.create', 'employees.edit'], function ($view) {
            return $view->with(
                'departments',
                \App\Models\Department::select('id', 'id')->get()
            );
        });

		View::composer(['employees.create', 'employees.edit'], function ($view) {
            return $view->with(
                'positions',
                \App\Models\Position::select('id', 'id')->get()
            );
        });

		View::composer(['pengajuans.create', 'pengajuans.edit'], function ($view) {
            return $view->with(
                'employees',
                \App\Models\Employee::select('id', 'created_at')->get()
            );
        });

		View::composer(['pengajuans.create', 'pengajuans.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'created_at')->get()
            );
        });

	}
}