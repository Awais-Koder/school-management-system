<?php

namespace App\Filament\Resources\BsOneResource\Pages;

use App\Filament\Resources\BsOneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsOnes extends ListRecords
{
    protected static string $resource = BsOneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
