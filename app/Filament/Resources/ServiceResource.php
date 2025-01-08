<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

use function Filament\Support\format_number;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Serviços';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->columnSpan(2),
                        Money::make('price')
                            ->label('Preço')
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('duration')
                            ->label('Duração em minutos')
                            ->prefixIcon('heroicon-o-clock')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        FileUpload::make('photo')
                            ->image()
                            ->columnSpan(2),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->url(fn($record) => '/storage/' . $record->photo)
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nome'),
                TextColumn::make('price')
                    ->label('Preço')
                    ->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
                    TextColumn::make('duration')
                        ->label('Duração em minutos')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
