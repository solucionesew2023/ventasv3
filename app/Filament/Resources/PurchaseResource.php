<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Purchase;
use App\Models\Provider;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Fieldset;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-in';
     protected static ?string $navigationGroup='Shopping';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Grid::make([
                    'default' => 1,
                    'sm' => 5,
                    'md' => 5,
                    'lg' => 5,
                    'xl' => 5,
                    '2xl' => 5,
                ])
                    ->schema([
                            Select::make('provider_id')->label('Provaider')
                        ->options(Provider::all()->pluck('name', 'id'))
                        ->searchable(),
                        DatePicker::make('purchase_date')->required(),
                        TextInput::make('invoice_number')->required(),
                        Select::make('status')->required()
                                ->options([
                                    'payable' => 'Payable',
                                    'paid' => 'Paid',
                                    'pass' => 'pass' ]),
                                    TextInput::make('total')->numeric()
                                    ->required()
                                    ->minValue(1),
                                ]),
                     Fieldset::make('Purchase detail')
                    ->schema([
                        Select::make('product_id')->label('Product')
                        ->required()
                        ->options(Product::all()->pluck('name', 'id'))
                        ->searchable(),
                        TextInput::make('purchase_price')->numeric()
                                    ->required()
                                    ->minValue(1),
                        TextInput::make('quantity')->numeric()
                                    ->required()
                                    ->minValue(1),
                        Select::make('color')->label('Color')
                        ->required()
                        ->options(Color::all()->pluck('name', 'id'))
                        ->searchable(),
                        Select::make('size')->label('Size')
                        ->required()
                        ->options(Size::all()->pluck('name', 'id'))
                        ->searchable(),

                    ])
                    ->columns(5)





            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')->sortable(),
                TextColumn::make('provider.name')->sortable()->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
