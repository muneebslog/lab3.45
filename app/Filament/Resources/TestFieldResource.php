<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\TestField;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\TestFieldResource\Pages;
use App\Filament\Resources\TestFieldResource\RelationManagers\NormalRangesRelationManager;

class TestFieldResource extends Resource
{
    protected static ?string $model = TestField::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('field_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_value')
                    ->required(),
                Forms\Components\TextInput::make('max_value')
                    ->required(),
                Forms\Components\Checkbox::make('multiple_ranges'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->searchable(),
                Tables\Columns\TextColumn::make('field_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_value')
                    ->numeric()
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
            NormalRangesRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestFields::route('/'),
            'create' => Pages\CreateTestField::route('/create'),
            'edit' => Pages\EditTestField::route('/{record}/edit'),
        ];
    }
}
