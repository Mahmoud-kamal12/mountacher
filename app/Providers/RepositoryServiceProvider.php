<?php

namespace App\Providers;

use App\Contract\DepartmentRepositoryInterface;
use App\Contract\TaskRepositoryInterface;
use App\Contract\UserRepositoryInterface;
use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use App\Repositories\Contracts\supplierPaymentInfosRepository;
use App\Repositories\Eloquent\EloquentDepartmentRepository;
use App\Repositories\Eloquent\EloquentTaskRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Neo4JsupplierPaymentInfosRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function (){
            return new EloquentUserRepository(new User());
        });

        $this->app->bind(DepartmentRepositoryInterface::class, function (){
            return new EloquentDepartmentRepository(new Department());
        });

        $this->app->bind(TaskRepositoryInterface::class, function (){
            return new EloquentTaskRepository(new Task());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
