<?php

namespace App\Filament\Resources\BsThirdTestResource\Pages;

use App\Filament\Resources\BsThirdTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsThirdTests extends ListRecords
{
    protected static string $resource = BsThirdTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
