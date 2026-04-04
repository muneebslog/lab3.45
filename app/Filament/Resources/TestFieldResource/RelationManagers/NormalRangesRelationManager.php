<?php

namespace App\Filament\Resources\TestFieldResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NormalRangesRelationManager extends RelationManager
{
    protected static string $relationship = 'normalRanges';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('gender')
                ->required()
                ->options([
                    'male'=>'male',
                    'female'=>'female',
                ]),
            Forms\Components\TextInput::make('min_value')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('max_value')
                ->required()
                ->numeric(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('gender')
            ->columns([
                Tables\Columns\TextColumn::make('gender'),
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
