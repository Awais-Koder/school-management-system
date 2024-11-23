<?php

namespace App\Filament\Resources\BsOneResource\Pages;

use App\Filament\Resources\BsOneResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsOne extends EditRecord
{
    protected static string $resource = BsOneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
