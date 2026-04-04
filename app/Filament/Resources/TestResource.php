<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers\TestFieldsRelationManager;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('department')
                ->label('Department Name')
                    ->required()
                    ->options([
                        'HEMATOLOGY' => 'HEMATOLOGY' ,
                        'SEROLOGY' => 'SEROLOGY' ,
                        'BIOCHEMISTRY' => 'BIOCHEMISTRY' ,
                        'MICROBIOLOGY' => 'MICROBIOLOGY' ,
                        'BLOOD BANKING ' => 'BLOOD BANKING ' ,
                        'PCR ' => 'PCR ' ,
                        'ELISA ' => 'ELISA ' ,

                    ])
                ,
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255)
                    ->unique("tests","code"),
                Forms\Components\TextInput::make('short_hand')
                    ->maxLength(255)
                    ->default(null),
                    Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rs')
                    ->maxValue(42949672.95),
                Forms\Components\TextArea::make('comment'),
                Select::make('test')
                    ->relationship('testFields', 'field_name')
                    ->preload()
                    ->multiple()
                    ->createOptionForm([
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
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('short_hand')
                    ->searchable(),
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
            TestFieldsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
