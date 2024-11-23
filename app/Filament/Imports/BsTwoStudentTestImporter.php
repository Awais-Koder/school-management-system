<?php

namespace App\Filament\Imports;

use App\Models\BsTwoStudentTest;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use App\Models\TempRollNumbers;

class BsTwoStudentTestImporter extends Importer
{
    protected static ?string $model = BsTwoStudentTest::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('roll_number')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('test_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('marks')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?BsTwoStudentTest
    {
        // return BsTwoStudentTest::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        TempRollNumbers::firstOrCreate([
            'roll_number' => $this->data['roll_number'],
            'test_id' => $this->data['test_id'],
        ]);
        return BsTwoStudentTest::firstOrNew([
            'roll_number' => $this->data['roll_number'],
            'test_id' => $this->data['test_id'],
            'marks' => $this->data['marks'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your bs two student test import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
