<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompraResource\Pages;
use App\Filament\Resources\CompraResource\RelationManagers;
use App\Models\Compra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompraResource extends Resource
{
    protected static ?string $model = Compra::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('descripcion')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('proveedors_id')
                ->relationship('Proveedor', 'nombre')
                ->required()
                ->searchable()
                ->preload(),
                Forms\Components\Select::make('products_id')
                ->relationship('Product', 'nombre')
                ->required()
                ->searchable()
                ->preload(),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(name: 'Proveedor.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make(name: 'Product.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad')
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
                Tables\Actions\DeleteAction::make()->action(function (Compra $record) {
                    $record->delete(); // Eliminar suavemente
                }),
                Tables\Actions\RestoreAction::make()->action(function (Compra $record) {
                    $record->restore(); // Restaurar registro eliminado
                }),
                Tables\Actions\Action::make('forceDelete')
                    ->label('Borrar Definitivamente')
                    ->action(function (Compra $record) {
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
            'index' => Pages\ListCompras::route('/'),
            'create' => Pages\CreateCompra::route('/create'),
            'edit' => Pages\EditCompra::route('/{record}/edit'),
        ];
    }
}
