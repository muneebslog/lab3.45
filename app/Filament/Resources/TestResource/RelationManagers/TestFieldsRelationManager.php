<?php

namespace App\Filament\Resources\TestResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;

class TestFieldsRelationManager extends RelationManager
{
    protected static string $relationship = 'testFields';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('field_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_value')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('max_value')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('field_name')
            ->columns([
                Tables\Columns\TextColumn::make('field_name'),
                Tables\Columns\TextColumn::make('min_value'),
                Tables\Columns\TextColumn::make('max_value'),
                Tables\Columns\TextColumn::make('unit'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
