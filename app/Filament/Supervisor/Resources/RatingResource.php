<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\RatingResource\Pages;
use App\Filament\Supervisor\Resources\RatingResource\RelationManagers;
use App\Models\Rating;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mokhosh\FilamentRating\Components\Rating as FilamentRating;
use Mokhosh\FilamentRating\RatingTheme;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('description_id')
                ->relationship(name: 'description', titleAttribute: 'name')
                ->required(), 
            // Forms\Components\Select::make('user_id')
            //     ->relationship(name: 'user', titleAttribute: 'name')
            //     ->required(),
            Forms\Components\Select::make('companies_id')
                ->relationship(name: 'companies', titleAttribute: 'name')
                ->required(),  
            FilamentRating::make('rating') // Asegúrate de pasar un nombre de campo como 'rating'
                ->theme(RatingTheme::Simple),
            Forms\Components\TextInput::make('observation')
                    

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description.name')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('user.name')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('companies.name')
                    ->numeric()
                    ->sortable(),    
                RatingColumn::make('rating') // Usa RatingColumn para mostrar calificaciones
                    ->label('Calificación'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('observation')
                    ->numeric()
                    ->sortable(),
                
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
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
