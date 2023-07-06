<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Purchase;
use App\Models\Provider;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;

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
                                    ->required(),




                    ])





            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
