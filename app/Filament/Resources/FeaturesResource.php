<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturesResource\Pages;
use App\Filament\Resources\FeaturesResource\RelationManagers;
use App\Models\Features;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeaturesResource extends Resource
{
    protected static ?string $model = Features::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

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

                Forms\Components\Section::make('Product Information')
                    ->description('Enter Product description')
                    ->schema([
                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255),
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
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeatures::route('/create'),
            'edit' => Pages\EditFeatures::route('/{record}/edit'),
        ];
    }
}
