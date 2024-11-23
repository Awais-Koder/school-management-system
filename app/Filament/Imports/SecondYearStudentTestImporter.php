<?php

namespace App\Filament\Imports;

use App\Models\SecondYearStudentTest;
use App\Models\TempRollNumbers;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SecondYearStudentTestImporter extends Importer
{
    protected static ?string $model = SecondYearStudentTest::class;

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

    public function resolveRecord(): ?SecondYearStudentTest
    {
        TempRollNumbers::firstOrCreate([
            'roll_number' => $this->data['roll_number'],
            'test_id' => $this->data['test_id'],
        ]);
        return SecondYearStudentTest::firstOrNew([
            'roll_number' => $this->data['roll_number'],
            'test_id' => $this->data['test_id'],
            'marks' => $this->data['marks'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your second year student test import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
