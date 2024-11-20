<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\RequirementResource\Pages;
use App\Filament\Supervisor\Resources\RequirementResource\RelationManagers;
use App\Models\Requirement;
use App\Models\Company;
use App\Models\Point;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class RequirementResource extends Resource
{
    protected static ?string $model = Requirement::class;

    protected static ?string $navigationIcon = 'heroicon-m-inbox';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('empleado')
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->required(),
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
                // Forms\Components\Select::make('user_id')
                //     ->label('encargado')
                //     ->relationship(name: 'user', titleAttribute: 'name')
                //     ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(600)
                    ->extraAttributes(['style' => 'width: 100%; height: 100px;']),    
                Forms\Components\DatePicker::make('date_ini')
                    ->required(),
                Forms\Components\DatePicker::make('date_finish'),
                    
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'finish' => 'Finish',
                        'active' => 'Active',
                    ])
                    ->default('active'), // Establece el valor por defecto si es necesario
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('date_ini')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_finish')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge() // Muestra el estado como un botón o etiqueta colorida
                    ->formatStateUsing(fn ($state) => ucfirst($state)) // Capitaliza el estado
                    ->colors([
                        'danger' => 'pending', // Color gris para el estado 'pending'
                        'success' => 'finish',    // Color verde para el estado 'finish'
                        'warning' => 'activo',    // Color amarillo para el estado 'activo'
                    ]),
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
            'index' => Pages\ListRequirements::route('/'),
            'create' => Pages\CreateRequirement::route('/create'),
            'edit' => Pages\EditRequirement::route('/{record}/edit'),
        ];
    }
}
