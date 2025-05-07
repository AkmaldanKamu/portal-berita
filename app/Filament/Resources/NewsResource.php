<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\News;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NewsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('author_id')
                ->relationship('author', 'name')
                ->required(),
                Forms\Components\Select::make('news_category_id')
                ->relationship('newsCategory', 'title')
                ->required(),
                Forms\Components\TextInput::make('title')
                ->live(onBlur: true) // Ensure this method exists in your Filament version
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->required(),
                Forms\Components\TextInput::make('slug')
                ->readOnly(),
                Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->columnSpanFull()
                ->required(),
                Forms\Components\RichEditor::make('content')
                ->columnSpanFull()
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable(),
                Tables\Columns\TextColumn::make('newsCategory.title')
                    ->label('News Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
            ])
            ->filters([
                SelectFilter::make('author_id')
                    ->relationship('author', 'name')
                    ->label('Select Author'),
                SelectFilter::make('news_category_id')
                    ->relationship('newsCategory', 'title')
                    ->label('Select News Category'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
