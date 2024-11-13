<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
// use App\Filament\Resources\ProductKeysResource\Pages\ListProductKeys;
use App\Models\ProductKeys;
use Forms\Components\Boolean;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductKeysResource\Pages;
use App\Filament\Resources\ProductKeysResource\RelationManagers;

class ProductKeysResource extends Resource
{
    protected static ?string $model = ProductKeys::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Section::make('Product Category')
                    ->description('Enter Product Category')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship(name: 'product', titleAttribute: 'product_name')
                            ->native(false)
                            ->searchable(true)
                            ->live()
                            ->preload(true)
                            ->required(),
                        
                ]),

                Forms\Components\Section::make('Product Keys')
                    ->description('Enter Product Keys')
                    ->schema([
                        Forms\Components\TextInput::make('key_code')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Radio::make('sold_status')
                            ->label('Sold Status')
                            ->boolean(),
                        ]),
                 ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('product.product_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('key_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sold_status')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
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

    // protected function listRecords()
    // {
    //     return ListProductKeys::class;
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductKeys::route('/'),
            'create' => Pages\CreateProductKeys::route('/create'),
            'edit' => Pages\EditProductKeys::route('/{record}/edit'),
        ];
    }
}
