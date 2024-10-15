<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required(),
                TextInput::make('email')
                ->email()
                ->required(),
                TextInput::make('password')
                ->password()
                ->hiddenOn('edit')
                ->required(),
                Select::make('roles')
                ->multiple()
                ->relationship('roles', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('email_verified_at'),
                TextColumn::make('roles.name'),
            ])
            ->filters([
                //
                Tables\Filters\Filter::make('verified')
                ->query(fn (Builder $query): Builder => $query
                ->whereNotNull('email_verified_at')),
            ])
            //verificado
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Verify')
                ->icon('heroicon-m-check-badge')
                ->action(function (User $user){
                    $user ->email_verified_at = Date('Y-m-d H:i:s');
                    $user ->save();
                }),
                //no verificado
                Tables\Actions\Action::make('Unverify')
                ->icon('heroicon-m-x-circle')
                ->color('danger')
                ->action(function (User $user){
                    $user ->email_verified_at = null;
                    $user ->save();
                }),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
