<?php

namespace App\Filament\Resources;
use Illuminate\Support\Str;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Tax;
use App\Models\Brand;
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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup='Productos';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                ->label('Category')
                ->options(Category::all()->pluck(value:'name', key:'id')->toArray())
                ->reactive()
                ->afterStateUpdated(fn(callable $set) => $set('subcategory_id', null)),

   Select::make( name: 'subcategory_id' )
                ->label(label: 'SubCategory')
                ->required()
                ->options( function ( callable $get ) {

                    $category = Category::find( $get('category_id'));

                    if($category){
                        return $category->subcategories->pluck('name', 'id');
                    }
                    return Subcategory::all()->pluck('name','id');
                     }),
       TextInput::make('name')->required()
                ->unique(ignoreRecord:true)
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set)=> $set('slug',Str::slug($state))),
       TextInput::make('slug')->required()
                 ->unique(ignoreRecord:true),
       Select::make('brand_id')
                 ->label('Brands')
                 ->required()
                 ->options(Brand::all()->pluck(value:'name', key:'id')->toArray()),
       Select::make('tax_id')
                 ->label('Taxes')
                 ->required()
                 ->options(Tax::all()->pluck(value:'name', key:'id')->toArray()),
       TextInput::make('stock_min')->required()
                 ->Numeric(),
       Select::make('status')->required()
                 ->options([
                     'draft' => 'Draft',
                     'published' => 'Published',
                 ]),
       Card::make()
                 ->schema([
                    RichEditor::make('description')->required(),
                 ])->columns(1),
        FileUpload::make('image')->image()
                                ->multiple()
                                ->imageResizeTargetWidth('1920')
                                ->imageResizeTargetHeight('1080'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('subcategory.name')->sortable()->searchable(),
                TextColumn::make('subcategory.category.name')->sortable()->searchable(),
                TextColumn::make('brand.name')->sortable()->searchable(),
                TextColumn::make('tax.name')->sortable()->searchable(),

                TextColumn::make('stock_min')->sortable()->searchable(),

                TextColumn::make('status')->sortable()->searchable(),

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
