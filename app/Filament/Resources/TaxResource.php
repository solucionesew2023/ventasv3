<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaxResource\Pages;
use App\Filament\Resources\TaxResource\RelationManagers;
use App\Models\Tax;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
class TaxResource extends Resource
{
    protected static ?string $model = Tax::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup='Products';
    protected static ?int $navigationSort = 6;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')->required()
                                               ->unique(ignoreRecord:true),
                    TextInput::make('value')->required()
                                           ->Numeric()
                                           ->Placeholder('19% = 0.19'),
                                               ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('value')->sortable()->searchable(),
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
            'index' => Pages\ManageTaxes::route('/'),
        ];
    }
}
