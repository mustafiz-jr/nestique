<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationGroup = 'Sales Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel(Coupon::class)::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Toggle::make('is_active')
                    ->default(true)
                    ->helperText('Is this coupon active now?')
                    ->columnSpan(2),

                TextInput::make('code')
                    ->required()
                    ->unique('coupons', 'code', ignoreRecord: true)
                    ->maxLength(50)
                    ->label('Coupon Code'),

                Select::make('type')
                    ->options([
                        'percent' => 'Percentage',
                        'fixed' => 'Fixed Amount',
                    ])
                    ->required()
                    ->native(false)
                    ->label('Discount Type'),

                TextInput::make('value')
                    ->required()
                    ->numeric()
                    ->minValue(0.01)
                    ->step(0.01)
                    ->label('Discount Value'),

                TextInput::make('max_uses')
                    ->numeric()
                    ->minValue(1)
                    ->nullable()
                    ->label('Maximum Uses'),

                TextInput::make('used')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->label('Times Used'),

                TextInput::make('min_order')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->nullable()
                    ->label('Minimum Order Amount'),

                DateTimePicker::make('starts_at')
                    ->nullable()
                    ->label('Starts At'),

                DateTimePicker::make('ends_at')
                    ->nullable()
                    ->label('Expires At'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->searchable(),
                TextColumn::make('type')->searchable(),
                TextColumn::make('value'),
                TextColumn::make('max_uses'),
                TextColumn::make('used'),
                TextColumn::make('min_order'),
                TextColumn::make('starts_at'),
                TextColumn::make('ends_at'),
                TextColumn::make('is_active')->label('Active'),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
