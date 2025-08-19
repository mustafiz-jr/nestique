<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use League\CommonMark\Input\MarkdownInput;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->columnSpanFull('full')
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->icon('heroicon-o-building-storefront')
                            ->schema([
                                Toggle::make('has_variants')
                                    ->label('Has Variants')
                                    ->default(false)
                                    ->helperText('select if your product has multiple variants')
                                    ->columnSpan(2),
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->label("Category")
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->required(),

                                Select::make('brand_id')
                                    ->relationship('brand', 'name')
                                    ->label("Brand")
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'active' => 'Active',
                                        'archived' => 'Archived',
                                    ])
                                    ->default('draft'),
                                MarkdownEditor::make('description')
                                    ->columnSpan(2),
                            ])->columns(2),


                        Tabs\Tab::make('Inventory')
                            ->icon('heroicon-o-archive-box')
                            ->schema([
                                TextInput::make('sku')
                                    ->label('SKU Code')
                                    ->helperText('Stock Keeping Unit code'),

                                TextInput::make('barcode')
                                    ->label('Barcode')
                                    ->helperText('Product barcode number'),

                                TextInput::make('stock')
                                    ->label('Quantity in Stock')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('How many items are available?'),

                                Toggle::make('track_quantity')
                                    ->label('Track Inventory')
                                    ->default(true)
                                    ->helperText('Track stock levels for this product'),
                            ])
                            ->columns(2),

                        Tabs\Tab::make('Pricing')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                TextInput::make('price')
                                    ->label('Selling Price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('$')
                                    ->helperText('The price customers will pay'),

                                TextInput::make('regular_price')
                                    ->label('Regular Price')
                                    ->numeric()
                                    ->prefix('$')
                                    ->helperText('Original price before discount'),

                                TextInput::make('compare_at_price')
                                    ->label('Compare Price')
                                    ->numeric()
                                    ->prefix('$')
                                    ->helperText('Price to show for comparison'),

                                TextInput::make('cost_per_item')
                                    ->label('Cost per Item')
                                    ->numeric()
                                    ->prefix('$')
                                    ->helperText('Your cost for this product'),
                            ])
                            ->columns(2),

                        Tabs\Tab::make('Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Main Image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('assets/backend/products')
                                    ->helperText('Main product image'),

                                FileUpload::make('gallery')
                                    ->label('Additional Images')
                                    ->image()
                                    ->multiple()
                                    ->disk('public')
                                    ->directory('assets/backend/products')
                                    ->maxFiles(6)
                                    ->helperText('Add more product images'),
                            ]),


                        Tabs\Tab::make('Shipping')
                            ->icon('heroicon-o-truck')
                            ->schema([
                                TextInput::make('weight')
                                    ->label('Weight (kg)')
                                    ->numeric()
                                    ->helperText('Product weight in kilograms'),

                                TextInput::make('length')
                                    ->label('Length (cm)')
                                    ->numeric()
                                    ->helperText('Length in centimeters'),

                                TextInput::make('width')
                                    ->label('Width (cm)')
                                    ->numeric()
                                    ->helperText('Width in centimeters'),

                                TextInput::make('height')
                                    ->label('Height (cm)')
                                    ->numeric()
                                    ->helperText('Height in centimeters'),
                            ])
                            ->columns(2),

                        Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(60)
                                    ->helperText('Title for search engines (max 60 chars)'),

                                TextInput::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->helperText('Comma-separated keywords for SEO'),

                                MarkdownEditor::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->helperText('Description for search engines (max 160 chars)'),

                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug'),
                TextColumn::make('description')->wrap()->words(20),
                TextColumn::make('brand_category')
                    ->label('Brand-Category')
                    ->getStateUsing(function ($record) {
                        $brandName = optional($record->brand)->name ?? 'No Brand';
                        $categoryName = optional($record->category)->name ?? 'No Category';
                        return "{$brandName}
                        {$categoryName}";
                    })
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('brand', function (Builder $q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                            ->orWhereHas('category', function (Builder $q) use ($search) {
                                $q->where('name', 'like', "%{$search}%");
                            });
                    }),
                ImageColumn::make('thumbnail')->height('50px'),
                TextColumn::make('price'),
                TextColumn::make('sku'),
                TextColumn::make('weight'),
                TextColumn::make('height'),
                TextColumn::make('width'),
                TextColumn::make('length'),
                TextColumn::make('stock'),
                TextColumn::make('status'),
                TextColumn::make('tags')->wrap(),
                TextColumn::make('options')->wrap(),
                TextColumn::make('variants')->wrap(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->color('secondary'),
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
