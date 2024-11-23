<?php

namespace App\Filament\Resources\BsTwoResource\Pages;

use App\Filament\Resources\BsTwoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsTwo extends EditRecord
{
    protected static string $resource = BsTwoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
