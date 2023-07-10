<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColorResource\Pages;
use App\Filament\Resources\ColorResource\RelationManagers;
use App\Models\Color;
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

class ColorResource extends Resource
{
    protected static ?string $model = Color::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup='Products';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')->required()
                                               ->unique(ignoreRecord:true),

                                               ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),

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
            'index' => Pages\ListColors::route('/'),
            'create' => Pages\CreateColor::route('/create'),
            'edit' => Pages\EditColor::route('/{record}/edit'),
        ];
    }
}
