<?php


namespace App\Providers;


use App\Interfaces\BaseModelInterface;
use App\Models\BaseModel;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(BaseModelInterface::class, BaseModel::class);
    }
}