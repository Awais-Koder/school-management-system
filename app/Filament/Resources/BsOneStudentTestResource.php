<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BsOneStudentTestResource\Pages;
use App\Filament\Resources\BsOneStudentTestResource\RelationManagers;
use App\Models\BsOne;
use App\Models\BsOneStudentTest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ImportAction;
use App\Filament\Imports\BsOneStudentTestImporter;
use App\Models\TempRollNumbers;

class BsOneStudentTestResource extends Resource
{
    protected static ?string $model = BsOneStudentTest::class;
    protected static ?string $navigationGroup = 'BS One';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('roll_number')
                    ->label('Student Roll #')
                    ->searchable()
                    ->preload()
                    ->options(function () {
                        return BsOne::pluck('roll_no', 'roll_no');
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
            ->headerActions([
                ImportAction::make()
                    ->importer(BsOneStudentTestImporter::class)
                    ->label('Import')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->after(function () {

                        $currentRollNumbers = TempRollNumbers::pluck('roll_number')->toArray();
                        $studentRollNumbers = BsOne::pluck('roll_no')->toArray();

                        // Find the roll numbers that are in BsOne but not in TempRollNumbers
                        $diffRollNumbers = array_diff($studentRollNumbers, $currentRollNumbers);
                        $testId = TempRollNumbers::pluck('test_id')->first();
                        // Populate missing records in BsOneStudentTest for the difference
                        foreach ($diffRollNumbers as $rollNumber) {
                            BsOneStudentTest::firstOrCreate([
                                'roll_number' => $rollNumber,
                                'test_id' => $testId,  // Replace with the actual test_id
                                'marks' => 0,
                            ]);
                        }
                        TempRollNumbers::truncate();
                    })
            ])
            ->filters([
                //
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
            'index' => Pages\ListBsOneStudentTests::route('/'),
            'create' => Pages\CreateBsOneStudentTest::route('/create'),
            'edit' => Pages\EditBsOneStudentTest::route('/{record}/edit'),
        ];
    }
}
