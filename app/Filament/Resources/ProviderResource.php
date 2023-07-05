<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProviderResource\Pages;
use App\Filament\Resources\ProviderResource\RelationManagers;
use App\Models\Provider;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Department;
use App\Models\City;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\Select;


class ProviderResource extends Resource
{
    protected static ?string $model = Provider::class;
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup='Shopping';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()
                ->unique(ignoreRecord:true),
                TextInput::make('nit')->required()
                ->unique(ignoreRecord:true),
                TextInput::make('email')->required()
                ->email()
                ->unique(ignoreRecord:true),
                TextInput::make('phone')->required()
                ->numeric()
                ->unique(ignoreRecord:true),


                Select::make('department_id')
                ->label('Department')
                ->options(Department::all()->pluck(value:'name', key:'id')->toArray())
                ->reactive()
                ->afterStateUpdated(fn(callable $set) => $set('city_id', null)),

   Select::make( name: 'city_id' )
                ->label(label: 'City')
                ->required()
                ->options( function ( callable $get ) {

                    $department = Department::find( $get('department_id'));

                    if($department){
                        return $department->cities->pluck('name', 'id');
                    }
                    return City::all()->pluck('name','id');


                }),

                TextInput::make('address'),
                TextInput::make('name_contact'),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('nit')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('phone')->sortable()->searchable(),
                TextColumn::make('city.department.name')->sortable()->searchable(),
                TextColumn::make('city.name')->sortable()->searchable(),
                TextColumn::make('address')->sortable()->searchable(),
                TextColumn::make('name_contact')->sortable()->searchable(),

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProviders::route('/'),
            'create' => Pages\CreateProvider::route('/create'),
            'edit' => Pages\EditProvider::route('/{record}/edit'),
        ];
    }
}
