<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BsOneResource\Pages;
use App\Filament\Resources\BsOneResource\RelationManagers;
use App\Models\BsOne;
use App\Models\BsOneAttendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Imports\BsOneImporter;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\BsOneExporter;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use App\Services\StudentAttendenceService;
class BsOneResource extends Resource
{
    protected static ?string $model = BsOne::class;
    protected static ?string $navigationGroup = 'BS One';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'BS One Students';
    public static function getLabel(): string
    {
        return 'Bs One Student';
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
                    ->importer(BsOneImporter::class)
                    ->label('Import')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-down-tray'),
                ExportAction::make()
                    ->exporter(BsOneExporter::class)
                    ->label('Export')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-up-tray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('Submit Attendence')
                    ->icon('heroicon-o-check-circle')
                    ->color('primary')
                    ->action(function (Collection $records, array $data, StudentAttendenceService $attendanceService) {
                        $attendanceDate = $data['attendance_date'];
                        $attendanceService->markAttendance($records, $attendanceDate, "App\\Models\\BsOneAttendance", "App\\Models\\BsOne");
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
            'index' => Pages\ListBsOnes::route('/'),
            'create' => Pages\CreateBsOne::route('/create'),
            'edit' => Pages\EditBsOne::route('/{record}/edit'),
        ];
    }
}
