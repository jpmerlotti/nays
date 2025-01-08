<?php

namespace App\Filament\Clusters\Agenda\Resources;

use App\Filament\Clusters\Agenda;
use App\Filament\Clusters\Agenda\Resources\TreatmentResource\Pages;
use App\Filament\Clusters\Agenda\Resources\TreatmentResource\RelationManagers;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Atendimentos';

    protected static ?string $cluster = Agenda::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('customer_id')
                            ->label('Cliente')
                            ->options(Customer::all()->pluck('name', 'id'))
                            ->required()
                            ->columnSpan(1),
                        Select::make('service_id')
                            ->label('Serviço')
                            ->options(Service::all()->pluck('name', 'id'))
                            ->required()
                            ->columnSpan(1),
                        Money::make('value_cents')
                            ->required()
                            ->columnSpan(2),
                        DateTimePicker::make('start')
                            ->date(true)
                            ->label('Data')
                            ->required()
                    ])->columns(2)
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
