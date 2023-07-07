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
use Filament\Forms\Components\Repeater;

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


                        Select::make('product_ida')->label('Product')
                        ->required()
                        ->options(Product::all()->pluck('name', 'id'))
                        ->searchable(),
                        TextInput::make('product_pricea')->numeric()
                                    ->required()
                                    ->minValue(1),
                        TextInput::make('product_amounta')->numeric()
                                    ->required()
                                    ->minValue(1),
                        Select::make('colora')->label('Color')
                        ->required()
                        ->options(Color::all()->pluck('name', 'id'))
                        ->searchable(),
                        Select::make('sizea')->label('Size')
                        ->required()
                        ->options(Size::all()->pluck('name', 'id'))
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set)=> $set('product_id','product_ida'))



                        ,

                Repeater::make('Product_purchases')
                        ->relationship()

                        ->schema([
                            TextInput::make('product_id')->disabled(),
                            TextInput::make('purchase_price')->disabled(),
                            TextInput::make('product_amount')->disabled(),
                            TextInput::make('color')->disabled(),
                            TextInput::make('size')->disabled(),

                        ])



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
                TextColumn::make('purchase_date')
                                ->date('d-M-Y')
                                ->sortable()->searchable(),
                TextColumn::make('state')->sortable()->searchable(),
                TextColumn::make('invoice_number')->sortable()->searchable(),
                TextColumn::make('total')->sortable()->searchable(),
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
