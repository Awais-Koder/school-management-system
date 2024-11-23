<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BsEightTestResource\Pages;
use App\Filament\Resources\BsEightTestResource\RelationManagers;
use App\Models\BsEightTest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Storage;

class BsEightTestResource extends Resource
{
    protected static ?string $model = BsEightTest::class;
    protected static ?string $navigationGroup = 'BS Two';
    protected static ?string $navigationLabel = 'BS Two Test';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getLabel(): string
    {
        return 'BS Two Test';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('test_path')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
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
                Tables\Actions\Action::make('View')
                    ->label('View Test')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->url(fn($record) => Storage::url($record->test_path))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListBsEightTests::route('/'),
            'create' => Pages\CreateBsEightTest::route('/create'),
            'edit' => Pages\EditBsEightTest::route('/{record}/edit'),
        ];
    }
}
