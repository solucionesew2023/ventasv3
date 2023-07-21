<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeproviderResource\Pages;
use App\Filament\Resources\TypeproviderResource\RelationManagers;
use App\Models\Typeprovider;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;

class TypeproviderResource extends Resource
{
    protected static ?string $model = Typeprovider::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
            'index' => Pages\ListTypeproviders::route('/'),
            'create' => Pages\CreateTypeprovider::route('/create'),
            'edit' => Pages\EditTypeprovider::route('/{record}/edit'),
        ];
    }
}
