<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditpurchaseResource\Pages;
use App\Filament\Resources\CreditpurchaseResource\RelationManagers;
use App\Models\Creditpurchase;
use Filament\Forms;
use App\Models\Purchase;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

class CreditpurchaseResource extends Resource
{
    protected static ?string $model = Creditpurchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup='Shopping';
    protected static ?string $navigationLabel = 'Credit purchase';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('purchase_id')->label('Purchase')
                        ->options(Purchase::all()->pluck('invoice_number', 'id'))
                        ->searchable(),
                TextInput::make('total')->required(),
                TextInput::make('balance')->required(),

                DatePicker::make('payment_date')->required()->maxDate(now()),
                Select::make('typepay')
                        ->options([
                            'effective' => 'Effective',
                            'transfer' => 'Transfer',
                            'cheque' => 'Cheque',
                        ]),
                        TextInput::make('valuepay')->required(),
                        Card::make()
                 ->schema([
                    RichEditor::make('notes')->required(),
                 ])->columns(1),
                 FileUpload::make('evidence'),




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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCreditpurchases::route('/'),
        ];
    }
}
