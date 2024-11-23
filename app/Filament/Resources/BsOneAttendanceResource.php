<?php

namespace App\Filament\Resources;

use App\Filament\Exports\BsOneAttendanceExporter;
use App\Filament\Resources\BsOneAttendanceResource\Pages;
use App\Filament\Resources\BsOneAttendanceResource\RelationManagers;
use App\Models\BsOneAttendance;
use Filament\Actions\Exports\Downloaders\CsvDownloader;
use Filament\Actions\Exports\Http\Controllers\DownloadExport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Support\Collection;
use Vtiful\Kernel\Excel;
class BsOneAttendanceResource extends Resource
{
    protected static ?string $model = BsOneAttendance::class;
    protected static ?string $navigationGroup = 'BS One';
    protected static ?string $navigationLabel = 'BS One Attendance';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getLabel(): string
    {
        return 'Bs One Attendance';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('attendance_date'),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')->label('Student Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.roll_no')->label('Roll Number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendance_date')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
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
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ExportBulkAction::make('Export')
                    ->exporter(BsOneAttendanceExporter::class)
                    ->label('Export')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-up-tray')
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
            'index' => Pages\ListBsOneAttendances::route('/'),
            'create' => Pages\CreateBsOneAttendance::route('/create'),
            'edit' => Pages\EditBsOneAttendance::route('/{record}/edit'),
        ];
    }
}
