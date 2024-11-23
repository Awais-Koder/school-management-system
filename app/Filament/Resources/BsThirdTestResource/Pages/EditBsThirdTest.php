<?php

namespace App\Filament\Resources\BsThirdTestResource\Pages;

use App\Filament\Resources\BsThirdTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsThirdTest extends EditRecord
{
    protected static string $resource = BsThirdTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
