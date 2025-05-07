<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\NewsCategory;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsCategoryResource\Pages;
use App\Filament\Resources\NewsCategoryResource\RelationManagers;
use Illuminate\Support\Str;

class NewsCategoryResource extends Resource
{
    protected static ?string $model = NewsCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([ // Ensure the schema method is correctly defined in your Filament version
                Forms\Components\TextInput::make('title')
                ->live(onBlur: true) // Ensure this method exists in your Filament version
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->required(),
                Forms\Components\TextInput::make('slug')
                ->readOnly()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ // Ensure the columns method is correctly defined in your Filament version
                Tables\Columns\TextColumn::make('title') // Ensure the make method exists in your Filament version
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug') // Ensure the make method exists in your Filament version
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Ensure the make method exists in your Filament version
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([ // Ensure the make method exists in your Filament version
                    Tables\Actions\DeleteBulkAction::make(), // Ensure the make method exists in your Filament version
                ]),
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
            'index' => Pages\ListNewsCategories::route('/'),
            'create' => Pages\CreateNewsCategory::route('/create'),
            'edit' => Pages\EditNewsCategory::route('/{record}/edit'),
        ];
    }
}
