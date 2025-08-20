<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Sales Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel(Order::class)::count();
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
                TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->tooltip('Copy order number'),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->placeholder('Guest'),

                TextColumn::make('total')
                    ->label('Total Amount')
                    ->money('USD')
                    ->sortable()
                    ->color('success')
                    ->weight('bold'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'secondary' => 'pending',
                        'info' => 'confirmed',
                        'warning' => 'processing',
                        'primary' => 'shipped',
                        'success' => ['delivered', 'completed'],
                        'danger' => ['cancelled', 'refunded'],
                        'gray' => 'returned',
                    ])
                    ->icons([
                        'heroicon-o-clock' => 'pending',
                        'heroicon-o-check-circle' => 'confirmed',
                        'heroicon-o-refresh' => 'processing',
                        'heroicon-o-truck' => 'shipped',
                        'heroicon-o-check-badge' => 'delivered',
                        'heroicon-o-arrow-uturn-left' => 'returned',
                        'heroicon-o-receipt-refund' => 'refunded',
                        'heroicon-o-x-circle' => 'cancelled',
                        'heroicon-o-sparkles' => 'completed',
                    ])
                    ->sortable(),

                BadgeColumn::make('payment_status')
                    ->label('Payment Status')
                    ->colors([
                        'secondary' => 'pending',
                        'warning' => 'processing',
                        'success' => 'completed',
                        'danger' => 'failed',
                    ])
                    ->icons([
                        'heroicon-o-clock' => 'pending',
                        'heroicon-o-arrow-path' => 'processing',
                        'heroicon-o-check-badge' => 'completed',
                        'heroicon-o-x-circle' => 'failed',
                    ]),

                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->badge()
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('M j, Y g:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('coupon_code')
                    ->label('Coupon Used')
                    ->placeholder('None')
                    ->badge()
                    ->color('warning')
                    ->toggleable(),

                TextColumn::make('discount_amount')
                    ->label('Discount')
                    ->money('USD')
                    ->color('danger')
                    ->toggleable(),

                TextColumn::make('shipping_method')
                    ->label('Shipping Method')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('tracking')
                    ->label('Tracking #')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make()->color('secondary'),
                // Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrder::route('/create'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
