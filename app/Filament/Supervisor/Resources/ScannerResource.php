<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\ScannerResource\Pages;
use App\Filament\Supervisor\Resources\ScannerResource\RelationManagers;
use App\Models\Scanner;
use App\Models\Company;
use App\Models\Point;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Carbon\Carbon;

class ScannerResource extends Resource
{
    protected static ?string $model = Scanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
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
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\DatePicker::make('date_default')
                    ->default(Carbon::now()->toDateString()) // Establece la fecha actual como valor por defecto
                    ->displayFormat('Y-m-d') // Formato de visualización opcional
                    ->required() // Si es un campo obligatorio
                    ->disabled(), // Deshabilita el campo
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('companies.name')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('point_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('date_default')
                    ->date()
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
            'index' => Pages\ListScanners::route('/'),
            'create' => Pages\CreateScanner::route('/create'),
            'edit' => Pages\EditScanner::route('/{record}/edit'),
        ];
    }
}
