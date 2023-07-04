<?php

namespace App\Filament\Resources;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'User Management';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              TextInput::make('name')->required()
               ->maxLength(255)
               ->label('Nombre de usuario'),

               TextInput::make('email')
               ->required()
               ->regex('/^.+@.+$/i')
               ->unique(ignoreRecord: true)
               ->label('Email address')
               ->email(),

               TextInput::make('password')
               ->label('Password')
               ->password()
               ->disableAutocomplete()
               ->minLength(8)
               ->same('passwordConfirmation')
               ->dehydrateStateUsing(static fn(null|string $state):
                                   null|string=>
                                   filled($state)?Hash::make($state):null,
                                    )
                ->required(static fn(Page $livewire): string=>
                                    $livewire instanceof CreateUser,
                                    )
                ->dehydrated(static fn(null|string $state):bool=>
                                    filled($state),

                                    )->label(static fn(Page $livewire): string =>
                                    ($livewire instanceof EditUser)?'New Password':'Password'
                                    ),
                TextInput::make('passwordConfirmation')
                ->label('Password confirmation')
                ->password()
                ->disableAutocomplete()
                ->minLength(8)
                ->required(static fn(Page $livewire): string=>
                                    $livewire instanceof CreateUser)
                ->dehydrated(false),

                Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')->preload(),

                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean(),
                Tables\Columns\TextColumn::make('roles.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
                    TextColumn::make('deleted_at')
                    ->dateTime('d-M-Y')
                    ->sortable()
                    ->searchable(),
                    TextColumn::make('created_at')
                    ->dateTime('d-M-Y')
                    ->sortable()
                    ->searchable(),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
