<?php

namespace App\Filament\Resources\TestFieldResource\Pages;

use App\Filament\Resources\TestFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestField extends EditRecord
{
    protected static string $resource = TestFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
