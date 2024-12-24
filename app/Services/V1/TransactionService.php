<?php

namespace App\Services\V1;

use App\Models\Transaction;
use App\Services\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TransactionService extends Service
{
    private function validate(string $context = 'create', array $data): array
    {
        $rules = match ($context) {
            'create' => [
                'type' => 'required',
                'value_cents' => 'required'
            ],
            'update' => [
                'type' => 'required',
                'value_cents' => 'required'
            ],
            'show' => [
                'id' => 'required|int|exists:transactions,id'
            ],
            default => [],
        };

        $messages = [
            'type.required' => 'O campo Tipo é obrigatório.',
            'value_cents.required' => 'O campo Valor é obrigatório.',
            'id.required' => 'O campo ID é obrigatório.',
            'id.int' => 'O campo ID deve ser um inteiro.',
            'id.exists' => 'O campo ID deve ser um ID válido na tabela de Transações.'
        ];

        $validator = Validator::make(data: $data, rules: $rules, messages: $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validate();
    }

    public function create(array $data): Transaction
    {
        $data = $this->prepareData($data);

        $validated = $this->validate('create', data: $data);

        return Transaction::create($validated);
    }

    public function update(int $id, array $data): bool
    {
        $record = $this->show($id);

        $data = $this->prepareData($data);

        $validated = $this->validate('update', $data);

        return $record->updateOrFail($validated);
    }

    public function show(int $id): ?Transaction
    {
        return Transaction::findOrFail($id);
    }

    private function prepareData(array $data): array
    {
        $data['value_cents'] = $data['value_cents'] * 100;
        return $data;
    }
}
