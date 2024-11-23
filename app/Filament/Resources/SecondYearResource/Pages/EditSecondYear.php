<?php

namespace App\Filament\Resources\SecondYearResource\Pages;

use App\Filament\Resources\SecondYearResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecondYear extends EditRecord
{
    protected static string $resource = SecondYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
