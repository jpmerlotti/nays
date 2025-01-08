<?php
namespace App\Services\V1;

use App\Models\Service as ModelsService;
use App\Services\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServiceService extends Service
{
    public function validate(array $data, string $context = 'create'): array
    {
        $rules = match ($context) {
            default => [],
            'create' => [
                'name' => 'string|required',
                'duration' => 'int|required',
                'price' => 'required',
                'photo' => 'nullable'
            ]
        };

        $messages = [];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validate();
    }

    public function create(array $data): ModelsService
    {
        $data = $this->prepareData($data);

        $validated = $this->validate($data);

        return ModelsService::create($validated);
    }

    public function update(int $id, array $data): bool
    {
        $record = $this->show($id);

        if (!$record) {
            throw new \Exception('Serviço não encontrado - ID inválido.');
        }

        $data = $this->prepareData($data);

        $validated = $this->validate($data, 'update');

        return $record->updateOrFail($validated);
    }

    public function show(int $id): ModelsService
    {
        return ModelsService::findOrFail($id);
    }

    private function prepareData(array $data): array
    {
        $data['price'] = $data['price'] * 100;
        return $data;
    }
}
