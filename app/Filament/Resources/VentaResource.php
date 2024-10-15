<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentaResource\Pages;
use App\Filament\Resources\VentaResource\RelationManagers;
use App\Models\Venta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('descripcion')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('clientes_id')
                    ->relationship('Cliente', 'nombre')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('products_id')
                ->relationship('Product', 'nombre')
                ->required()
                ->searchable()
                ->preload(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(name: 'Cliente.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make(name: 'Product.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')->dateTime()->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(), // Filtro para registros eliminados
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->action(function (Venta $record) {
                    $record->delete(); // Eliminar suavemente
                }),
                Tables\Actions\RestoreAction::make()->action(function (Venta $record) {
                    $record->restore(); // Restaurar registro eliminado
                }),
                Tables\Actions\Action::make('forceDelete')
                    ->label('Borrar Definitivamente')
                    ->action(function (Venta $record) {
                        $record->forceDelete(); // Borrado definitivo
                    })
                    ->requiresConfirmation(), // Solicita confirmación antes de borrar
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVentas::route('/'),
            'create' => Pages\CreateVenta::route('/create'),
            'edit' => Pages\EditVenta::route('/{record}/edit'),
        ];
    }
}
