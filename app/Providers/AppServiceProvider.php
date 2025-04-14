<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\estatu;
use App\Models\registro;
use App\Models\sistema;
use App\Models\User;
use Illuminate\Pagination\Paginator; 
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https://');
        }

        Paginator::useBootstrap();
        //URL::forceScheme('https');

        Paginator::useBootstrap();
        // Cargar los datos que quieres compartir globalmente
        $UsPIP = User::whereIn('id', registro::groupBy('id_responsable')->select('id_responsable'))->orderby('nombre', 'asc')->get();  // O cualquier consulta específica
        $cl = Cliente::orderby('nombre_cl', 'asc')->get();  // O cualquier consulta específica
        $s = sistema::orderby('nombre_s', 'asc')->get();  // O cualquier consulta específica
        $status = estatu::whereNotNull('id_fase')->orderBy('posicion')->get();

        // Compartir las variables globalmente con todas las vistas
        view()->share('UsPIP', $UsPIP);
        view()->share('cl', $cl);
        view()->share('s', $s);
        view()->share('status', $status);
    }
}
