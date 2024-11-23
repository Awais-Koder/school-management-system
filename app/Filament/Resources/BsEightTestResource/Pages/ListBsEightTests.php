<?php

namespace App\Filament\Resources\BsEightTestResource\Pages;

use App\Filament\Resources\BsEightTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsEightTests extends ListRecords
{
    protected static string $resource = BsEightTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
