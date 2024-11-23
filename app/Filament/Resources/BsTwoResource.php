<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BsTwoResource\Pages;
use App\Filament\Resources\BsTwoResource\RelationManagers;
use App\Models\BsTwo;
use App\Models\BsTwoAttendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Imports\BsTwoImporter;
use Filament\Tables\Actions\ImportAction;
use App\Filament\Exports\BsTwoExporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use App\Services\StudentAttendenceService;

class BsTwoResource extends Resource
{
    protected static ?string $model = BsTwo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'BS Two';
    protected static ?string $navigationLabel = 'BS Two Students';
    public static function getLabel(): string
    {
        return 'Bs Two Students';
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->placeholder('Student Name Here')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('father_name')
                ->placeholder('Father Name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('roll_no')
                ->placeholder('Roll Number Here')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('contact_numner')
                ->placeholder('Student Contact Number')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('father_contact_numner')
                ->placeholder('Father Contact Number')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roll_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_numner')
                ->label('Contact Number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_contact_numner')
                ->label('Father Contact Number')
                    ->searchable(),
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ImportAction::make()
                ->label('Import')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->importer(BsTwoImporter::class),
                    ExportAction::make()
                    ->label('Export')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-up-tray')
                ->exporter(BsTwoExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('Submit Attendence')
                    ->icon('heroicon-o-check-circle')
                    ->color('primary')
                    ->action(function (Collection $records, array $data, StudentAttendenceService $attendanceService) {
                        $attendanceDate = $data['attendance_date'];
                        $attendanceService->markAttendance($records, $attendanceDate, "App\\Models\\BsTwoAttendance", "App\\Models\\BsTwo");
                    })
                    ->form([
                        Forms\Components\DateTimePicker::make('attendance_date')
                            ->label('Select Attendance Date')
                            ->default(Carbon::today()),
                    ])
                    ->requiresConfirmation(),
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
            'index' => Pages\ListBsTwos::route('/'),
            'create' => Pages\CreateBsTwo::route('/create'),
            'edit' => Pages\EditBsTwo::route('/{record}/edit'),
        ];
    }
}
