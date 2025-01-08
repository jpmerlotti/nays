<?php

namespace App\Filament\Widgets;

use App\Filament\Clusters\Agenda\Resources\TreatmentResource\Pages\CreateTreatment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Treatment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Leandrocfe\FilamentPtbrFormFields\Money;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class SchedulingCalendarWidget extends TableWidget
{
    protected static string | Model | null $model = Treatment::class;

    protected string | int | array $columnSpan = [
        'sm' => 1,
        'md' => 3
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => Treatment::query()->where('start', 'like', now()->startOfDay())->where('start', 'like', now()->endOfDay()))
            ->heading('Atendimentos para hoje')
            ->headerActions([
                CreateAction::make('create.treatment')
                    ->label('Adicionar Atendimento')
                    ->modal()
                    ->modalHeading('Adicionar atendimento')
                    ->form([
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
                    ])
            ])
            ->columns([
                TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->formatStateUsing(function (Customer $model) {
                        return $model->customer->getShortName();
                    }),
                TextColumn::make('service.name')
                    ->label('Serviço'),
                TextColumn::make('start')
                    ->label('Horário')
                    ->formatStateUsing(function (Model $model) {
                        return $model->start->format('H:i');
                    }),
            ]);
    }
}
