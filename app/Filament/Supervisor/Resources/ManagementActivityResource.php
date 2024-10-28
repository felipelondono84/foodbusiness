<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\ManagementActivityResource\Pages;
use App\Filament\Supervisor\Resources\ManagementActivityResource\RelationManagers;
use App\Models\ManagementActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ManagementActivityResource extends Resource
{
    protected static ?string $model = ManagementActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('users_id', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('activities_id')
                    ->relationship(name: 'activities', titleAttribute: 'name')
                    ->required(),
                // Forms\Components\Select::make('users_id')
                //     ->relationship(name: 'users', titleAttribute: 'name')
                //     ->required(),
                Forms\Components\Select::make('comanpanies_id')
                    ->relationship(name: 'comanpanies', titleAttribute: 'name')
                    ->label('Company')
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\DateTimePicker::make('day_in'),
                Forms\Components\DateTimePicker::make('day_out'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('activities.name')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('users.name')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('comanpanies.name')
                ->label('Company')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('day_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day_out')
                    ->dateTime()
                    ->sortable(),

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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListManagementActivities::route('/'),
            'create' => Pages\CreateManagementActivity::route('/create'),
            'edit' => Pages\EditManagementActivity::route('/{record}/edit'),
        ];
    }
}
