<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Product;
use App\Models\Proveedor;
use App\Models\Role;
use App\Models\User;
use App\Models\Venta;
use App\Policies\ClientePolicy;
use App\Policies\CompraPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProveedorPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Cliente::class => ClientePolicy::class,
        Product::class => ProductPolicy::class,
        Compra::class => CompraPolicy::class,
        Proveedor::class => ProveedorPolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Venta::class => Venta::class,
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
