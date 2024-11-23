<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BsTwoStudentTestResource\Pages;
use App\Filament\Resources\BsTwoStudentTestResource\RelationManagers;
use App\Models\BsTwo;
use App\Models\BsTwoStudentTest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ImportAction;
use App\Filament\Imports\BsTwoStudentTestImporter;
use App\Models\TempRollNumbers;

class BsTwoStudentTestResource extends Resource
{
    protected static ?string $model = BsTwoStudentTest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'BS Two';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('roll_number')
                    ->label('Student Roll #')
                    ->searchable()
                    ->preload()
                    ->options(function () {
                        return BsTwo::pluck('roll_no', 'roll_no');
                    })
                    ->native(false),
                Forms\Components\Select::make('test_id')
                    ->label('Select Test')
                    ->relationship('test', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('marks')
                    ->maxLength(255)
                    ->placeholder('Test Marks Here')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.roll_no')
                    ->label('Student Roll #')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('test.name')
                    ->label('Test Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('marks')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(BsTwoStudentTestImporter::class)
                    ->label('Import')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->after(function () {

                        $currentRollNumbers = TempRollNumbers::pluck('roll_number')->toArray();
                        $studentRollNumbers = BsTwo::pluck('roll_no')->toArray();

                        // Find the roll numbers that are in BsOne but not in TempRollNumbers
                        $diffRollNumbers = array_diff($studentRollNumbers, $currentRollNumbers);
                        $testId = TempRollNumbers::pluck('test_id')->first();
                        // Populate missing records in BsOneStudentTest for the difference
                        foreach ($diffRollNumbers as $rollNumber) {
                            BsTwoStudentTest::firstOrCreate([
                                'roll_number' => $rollNumber,
                                'test_id' => $testId,  // Replace with the actual test_id
                                'marks' => 0,
                            ]);
                        }
                        TempRollNumbers::truncate();
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBsTwoStudentTests::route('/'),
            'create' => Pages\CreateBsTwoStudentTest::route('/create'),
            'edit' => Pages\EditBsTwoStudentTest::route('/{record}/edit'),
        ];
    }
}
