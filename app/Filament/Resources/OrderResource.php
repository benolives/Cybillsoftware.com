<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables as FilamentTables; // Alias to avoid conflict
use App\Models\Order;
use Filament\Forms as FilamentForms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\DatetimeColumn; 
use Filament\Tables\Columns\TextColumn; 
use Filament\Resources\Resource;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(FilamentForms\Form $form): FilamentForms\Form
    {
        return $form
            ->schema([
                FilamentForms\Components\TextInput::make('product_id')
                    ->label('Product ID')
                    ->required(),
                FilamentForms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email(),
                FilamentForms\Components\TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->required(),
                FilamentForms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric(),
                FilamentForms\Components\TextInput::make('status')
                    ->label('Order Status')
                    ->required(),
                FilamentForms\Components\DatePicker::make('transaction_date')
                    ->label('Transaction Date')
                    ->required(),
            ]);
    }

    public static function table(FilamentTables\Table $table): FilamentTables\Table
    {
        return $table
            ->columns([
                FilamentTables\Columns\TextColumn::make('id')
                    ->label('Order ID'),
                FilamentTables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->sortable()
                    ->label('Phone Number'),
                FilamentTables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Customer Email'),
                FilamentTables\Columns\TextColumn::make('amount')
                    ->sortable()
                    ->label('Amount'),
                FilamentTables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'info' => 'shipped',
                    ])
                    ->label('Status'),
                FilamentTables\Columns\TextColumn::make('transaction_date')
                    ->sortable()
                    ->label('Transaction Date'),
                FilamentTables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('Created At'),
                FilamentTables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->label('Updated At'),
            ])
            ->filters([
                // Add any specific filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            // Define relationships if there are any
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}