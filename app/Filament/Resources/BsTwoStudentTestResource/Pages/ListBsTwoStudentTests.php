<?php

namespace App\Filament\Resources\BsTwoStudentTestResource\Pages;

use App\Filament\Resources\BsTwoStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsTwoStudentTests extends ListRecords
{
    protected static string $resource = BsTwoStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
