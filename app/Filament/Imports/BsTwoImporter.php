<?php

namespace App\Filament\Imports;

use App\Models\BsTwo;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class BsTwoImporter extends Importer
{
    protected static ?string $model = BsTwo::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->rules(['max:255']),
            ImportColumn::make('father_name')
                ->rules(['max:255']),
            ImportColumn::make('roll_no')
                ->rules(['max:255']),
            ImportColumn::make('contact_numner')
                ->rules(['max:255']),
            ImportColumn::make('father_contact_numner')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?BsTwo
    {
        // return BsTwo::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new BsTwo();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your bs two import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
