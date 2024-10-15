<?php

namespace App\Filament\Resources\CompraResource\Pages;

use App\Filament\Resources\CompraResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompra extends CreateRecord
{
    protected static string $resource = CompraResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index'); // Redirigir a la tabla de clientes
    }
}
