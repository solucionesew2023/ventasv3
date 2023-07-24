<?php
namespace App\Filament\Resources;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
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
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Hidden;

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
                        TableRepeater::make('product_purchases')
                        ->columnWidths([
                            'subtotal' => '150px',
                            'product_amount' => '100px',
                            'product_price' => '100px',
                            'iva' => '100px',
                        ])

                                    ->relationship()
                                    ->schema([
                                        Select::make('product_id')->label('Product')
                                        ->disableLabel()
                                        ->required()
                                        ->options(Product::all()->pluck('name', 'id'))
                                        ->searchable(),
                                        Select::make('color')->label('Color')
                                        ->disableLabel()
                                        ->required()
                                                        ->options(Color::all()->pluck('name', 'name'))
                                                        ->searchable(),
                                        Select::make('size')->label('Size')
                                        ->disableLabel()
                                        ->required()
                                                        ->options(Size::all()->pluck('name', 'name'))
                                                        ->searchable(),
                                        TextInput::make('product_price')->numeric()
                                        ->disableLabel()
                                        ->required()
                                                    ->minValue(1)
                                                   ->reactive()
                                                   ->afterStateUpdated(function(Closure  $set, $get){
                                                    $set('subtotal', $get('product_price') * $get('product_amount'));


                                                   }),

                        TextInput::make('product_amount')->numeric()
                        ->disableLabel()
                        ->required()
                                                    ->minValue(1)
                                                   ->reactive()
                        ->afterStateUpdated(function(Closure  $set, $get){
                            $set('subtotal', $get('product_price') * $get('product_amount'));


                           }),
                           TextInput::make('iva')
                           ->disableLabel()
                                                     ->disabled(),
                        TextInput::make('subtotal')
                          ->disableLabel()
                                                    ->disabled(),


                                    ])
                                    ->columnSpan('full'),


                                    Placeholder::make("iva_total")
                                    ->label("Total iva")
                                    ->content(function ($get) {
                                        return collect($get('product_purchases'))
                                            ->pluck('iva')
                                            ->sum();
                                    }),
                                Placeholder::make("total")
                                ->label("Total purchase")
                                ->content(function ($get) {
                                    return collect($get('product_purchases'))
                                        ->pluck('subtotal')
                                        ->sum();
                                }),


                        TableRepeater::make('invoice_payments')

                                    ->schema([
                                        DatePicker::make('payment_date')->required()->maxDate(now())
                                        ->disableLabel(),
                                        Select::make('payment_method')
                                                ->options([
                                                    'effective' => 'Effective',
                                                    'transfer' => 'Transfer',
                                                    'cheque' => 'Cheque',
                                                ])
                                                ->disableLabel(),
                                      TextInput::make('value_pay')->required()
                                      ->reactive()
                                      ->disableLabel()

                                      ,
                                      TextInput::make('note')->required()
                                      ->disableLabel()
                                                ->Placeholder('Check number, bank, etc'),



                                      FileUpload::make('evidence')
                                      ->disableLabel()
                                      ->directory('evidence_payment')
                                      ->enableReordering()
                                      ->enableDownload()
                                      ->enableOpen(),

                                    ])->columnSpan('full')
                                    ->createItemButtonLabel('Add Invoice payments'),


                                   Placeholder::make("balance")
                                    ->label("Total Balance")
                                    ->content(function ($get) {

                                        $val =collect($get('invoice_payments'))
                                        ->pluck('value_pay')
                                        ->sum();

                                        $val2 =collect($get('product_purchases'))
                                        ->pluck('subtotal')
                                        ->sum();

                                        return  $val2 - $val;
                                        })




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
