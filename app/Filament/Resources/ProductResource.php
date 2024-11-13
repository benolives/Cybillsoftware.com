<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms\Form;
use Forms\Components\ID;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Forms\Components\BelongsToSelect;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Section::make('Product Category')
                    ->description('Enter Product Category')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship(name: 'category', titleAttribute: 'name')
                            ->native(false)
                            ->searchable(true)
                            ->live()
                            ->preload(true)
                            ->required(),
                        
                ]),
                Forms\Components\Section::make('Product Information')
                    ->description('Enter Product Information')
                    ->schema([
                        Forms\Components\TextInput::make('product_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('price_offer')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('price_partner')
                            ->required()
                            ->numeric(),
                        Forms\Components\FileUpload::make('image_url'),
                        Forms\Components\TextInput::make('product_link')
                            ->required()
                            ->maxLength(255),
                ])->columns(2),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->searchable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
