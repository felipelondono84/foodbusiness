<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\ChecklistItemResource\Pages;
use App\Filament\Supervisor\Resources\ChecklistItemResource\RelationManagers;
use App\Models\ChecklistItem;
use App\Models\Company;
use App\Models\Point;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ChecklistItemResource extends Resource
{
    protected static ?string $model = ChecklistItem::class;

    protected static ?string $navigationIcon = 'heroicon-m-numbered-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Forms\Components\Select::make('condition_id')
                    ->relationship(name: 'condition', titleAttribute: 'name')
                    ->required(),
                Forms\Components\TextInput::make('observation')
                    ->required()
                    ->maxLength(255)   
                    ->required(),
                Forms\Components\Toggle::make('completed')
                    ->label('Completado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('condition.name')
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('companies.name')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('point_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('observation')
                ->searchable(),
                Tables\Columns\BooleanColumn::make('completed')
                    ->label('Completado'),
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
            'index' => Pages\ListChecklistItems::route('/'),
            'create' => Pages\CreateChecklistItem::route('/create'),
            'edit' => Pages\EditChecklistItem::route('/{record}/edit'),
        ];
    }
}
