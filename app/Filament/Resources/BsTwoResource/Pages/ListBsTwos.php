<?php

namespace App\Filament\Resources\BsTwoResource\Pages;

use App\Filament\Resources\BsTwoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsTwos extends ListRecords
{
    protected static string $resource = BsTwoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
