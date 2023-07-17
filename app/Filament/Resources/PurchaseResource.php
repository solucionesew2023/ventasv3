<?php

namespace App\Filament\Resources;
use Filament\Forms\Components\Section;
use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Purchase;
use App\Models\Provider;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

use Closure;
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
use Filament\Forms\Components\FileUpload;


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
                    'sm' => 4,
                    'md' => 4,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                    ->schema([
                        Select::make('provider_id')->label('Provaider')
                        ->options(Provider::all()->pluck('name', 'id'))
                        ->searchable(),
                        DatePicker::make('purchase_date')->required()->maxDate(now()),
                        TextInput::make('invoice_number')->required(),
                        Select::make('state')->required()
                                ->options(config('statepay.states')),

                                ]),
                                Section::make('Detail')
                                ->schema([

                                    Repeater::make('product_purchases')
                                    ->relationship()
                                    ->schema([
                                        Select::make('product_id')->label('Product')
                                        ->required()
                                        ->options(Product::all()->pluck('name', 'id'))
                                        ->searchable(),
                                        TextInput::make('product_price')->numeric()
                                                    ->required()
                                                    ->minValue(1)
                                                    ->reactive()
                        ->afterStateUpdated(function(Closure  $set, $get){

                            $set('subtotal', $get('product_price') * $get('product_amount'));
                            $set('total', $get('product_price') * $get('product_amount'));
                           }),
                        TextInput::make('product_amount')->numeric()
                                                    ->required()
                                                    ->minValue(1)
                                                    ->reactive()
                        ->afterStateUpdated(function(Closure  $set, $get){
                            $set('subtotal', $get('product_price') * $get('product_amount'));
                            $set('total', $get('product_price') * $get('product_amount'));
                           }),

                        TextInput::make('subtotal')
                                                    ->disabled(),
                        Select::make('color')->label('Color')
                                        ->required()
                                        ->options(Color::all()->pluck('name', 'name'))
                                        ->searchable(),
                        Select::make('size')->label('Size')
                                        ->required()
                                        ->options(Size::all()->pluck('name', 'name'))
                                        ->searchable(),

                                    ])
                                    ->columns(6),
                                    TextInput::make('total')->numeric()
                                    ->required()
                                    ->minValue(1),





                                ])
                                ->columns(1),

                                Section::make('Detail')
                                ->schema([
                                  Repeater::make('invoice_payments')
                                    ->schema([
                                        DatePicker::make('payment_date')->required()->maxDate(now()),
                                        Select::make('payment_method')
                                                ->options([
                                                    'effective' => 'Effective',
                                                    'transfer' => 'Transfer',
                                                    'cheque' => 'Cheque',
                                                ]),
                                      TextInput::make('value_pay')->required(),
                                      TextInput::make('note')->required(),
                                      FileUpload::make('evidence')
                                      ->directory('evidence_payment')
                                      ->enableReordering()
                                      ->enableDownload()
                                      ->enableOpen(),

                                    ])->columns(5)
                                    ->createItemButtonLabel('Add Invoice payments'),

                        TextInput::make('balance')->numeric()
                                    ->required()
                                    ->minValue(0)

                                ])
                                ->columns(1)















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
                TextColumn::make('balance')->sortable()->searchable(),
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
