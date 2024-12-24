<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Cofre';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('type')
                            ->label('Tipo de Transação')
                            ->options([
                                'entry' => 'Entrada',
                                'expense' => 'Saída',
                            ])
                            ->required()
                            ->columnSpan(1),
                        Money::make('value_cents')
                            ->label('Valor')
                            ->required()
                            ->columnSpan(1),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),
                        FileUpload::make('proof')
                            ->label('Comprovante')
                            ->acceptedFileTypes(['application/pdf', 'application/image'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Transaction::where('created_at', '!=', null)->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->date('d/m/Y H:i:s')
                    ->description(fn(Transaction $record) => $record->description),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->date('d/m/Y H:i:s'),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'entry' => 'Entrada',
                        'expense' => 'Saída'
                    })
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'entry' => 'success',
                        'expense' => 'danger'
                    }),
                TextColumn::make('value_cents')
                    ->label('Valor')
                    ->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
                TextColumn::make('proof')
                    ->label('Comprovante')
                    ->url(fn(Transaction $record) => $record->proof != null ? '/storage/' . $record->proof : null, true)
                    ->tooltip('Visualizar Comprovante')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
