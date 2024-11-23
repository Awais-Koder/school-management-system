<?php

namespace App\Filament\Resources\BsOneStudentTestResource\Pages;

use App\Filament\Resources\BsOneStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsOneStudentTests extends ListRecords
{
    protected static string $resource = BsOneStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
