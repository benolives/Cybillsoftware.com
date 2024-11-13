<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StkrequestResource\Pages;
use App\Filament\Resources\StkrequestResource\RelationManagers;
use App\Models\Stkrequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StkrequestResource extends Resource
{
    protected static ?string $model = Stkrequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Transactions';

    public static function getLabel(): string
    {
        return 'Sales'; 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('MpesaReceiptNumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TransactionDate'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('ResultDesc'),

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStkrequests::route('/'),
            'create' => Pages\CreateStkrequest::route('/create'),
            'edit' => Pages\EditStkrequest::route('/{record}/edit'),
        ];
    }
}