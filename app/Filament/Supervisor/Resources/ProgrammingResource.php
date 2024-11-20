<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\ProgrammingResource\Pages;
use App\Filament\Supervisor\Resources\ProgrammingResource\RelationManagers;
use App\Models\Programming;
use App\Models\Company;
use App\Models\Point;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProgrammingResource extends Resource
{
    protected static ?string $model = Programming::class;

    protected static ?string $navigationIcon = 'heroicon-c-calendar-days';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                // Forms\Components\TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),
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
                Forms\Components\DateTimePicker::make('date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                // Tables\Columns\TextColumn::make('user_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('companies.name')
                    ->label('Company')
                        ->numeric()
                        ->sortable(),
                Tables\Columns\TextColumn::make('date')
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
            'index' => Pages\ListProgrammings::route('/'),
            'create' => Pages\CreateProgramming::route('/create'),
            'edit' => Pages\EditProgramming::route('/{record}/edit'),
        ];
    }
}
