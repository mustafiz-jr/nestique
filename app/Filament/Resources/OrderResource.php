<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Doctrine\DBAL\Schema\Schema;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Infolists\Components\KeyValueEntry;
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
                Section::make('Customer & Status')
                    ->description('Select the customer and set the order status and payment details.')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->nullable(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                                'cancelled' => 'Cancelled',
                            ])->required()->helperText('Order Status.'),
                        Select::make('payment_method')
                            ->options([
                                'stripe' => 'Stripe',
                                'paypal' => 'PayPal',
                                'cod' => 'Cash on Delivery',
                            ])->nullable()->helperText('Payment method used.'),
                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                            ])->required()->helperText('Payment Status.'),
                        TextInput::make('payment_intent_id')->maxLength(255)->nullable()->helperText('Payment intent/reference ID.'),
                    ])->columns(2),
                Section::make('Order Details')
                    ->description('Set the order Total, Currency, shipping, and tracking information.')
                    ->schema([
                        TextInput::make('total')->numeric()->required()->helperText('Order total amount.'),
                        TextInput::make('currency')->maxLength(10)->default('USD')->helperText('Currency code.'),
                        TextInput::make('shipping_method')->maxLength(255)->nullable()->helperText('Shipping method used.'),
                        TextInput::make('tracking')->maxLength(255)->nullable()->helperText('Tracking number or URL.'),
                    ])->columns(2),
                Section::make('Addresses & Notes')
                    ->description('Enter shipping & billing address and any special notes for the order.')
                    ->schema([
                        Forms\Components\KeyValue::make('shipping_address')->label('Shipping Address')->helperText('Shipping address details.'),
                        Forms\Components\KeyValue::make('billing_address')->label('Billing Address')->helperText('Billing address details.'),
                        MarkdownEditor::make('notes')->nullable()->helperText('Order notes or special instructions.')->columnSpanFull(),
                    ])->columns(2),

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
                    ->weight('bold')
                    ->tooltip('Copy order number'),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->description(fn($record) => $record->user->email ?? 'Guest')
                    ->icon('heroicon-o-user'),


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

                TextColumn::make('tracking')
                    ->label('Tracking #')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('shipping_method')
                    ->label('Shipping Method')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('shipping_address.city')
                    ->label('City')
                    ->getStateUsing(fn($record) => $record->shipping_address['city'] ?? 'N/A')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-map-pin'),
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('discount_amount')
                    ->label('Discount')
                    ->money('USD')
                    ->color('danger')
                    ->toggleable(),

                TextColumn::make('total')
                    ->label('Total Amount')
                    ->money('USD')
                    ->sortable()
                    ->color('success')
                    ->weight('bold'),




            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->color('secondary'),
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
