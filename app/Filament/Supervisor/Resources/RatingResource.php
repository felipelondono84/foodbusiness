<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\RatingResource\Pages;
use App\Filament\Supervisor\Resources\RatingResource\RelationManagers;
use App\Models\Rating;
use App\Models\Company;
use App\Models\Point;
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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-m-hand-thumb-up';

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
            // Forms\Components\FileUpload::make('photo')
            //     ->label('Foto Capturada')
            //     ->image(), // Especifica que debe ser una imagen
            //     // ->required(),
                    
            
            Forms\Components\Select::make('companies_id')
            ->label('Empresa')
            ->options(Company::all()->pluck('name', 'id')->toArray()) // Asegúrate de convertirlo a un array
            ->required()
            ->reactive()
            ->afterStateUpdated(function (callable $set) {
                $set('point_id', null); // Reset point_id when companies_id changes
            }),

            // Dependent Select for Punto de Venta
            Forms\Components\Select::make('point_id')
                ->label('Punto de Venta')
                ->options(function (callable $get) {
                    $empresaId = $get('companies_id');
                    if ($empresaId) {
                        $options = Point::where('company_id', $empresaId)->pluck('nombre', 'id')->toArray();
                        return $options ?: []; // Devuelve un array vacío si no hay opciones
                    }
                    return [];
                })
                ->required(),//ampo obligatorio/ Asegúrate de que sea un campo numérico      
            Forms\Components\Select::make('user_id')
                ->relationship(name: 'user', titleAttribute: 'name')
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
                // Tables\Columns\TextColumn::make('points.nombre')
                //     ->label('Punto de Venta')
                //     ->sortable()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
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
                    ExportBulkAction::make()
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
