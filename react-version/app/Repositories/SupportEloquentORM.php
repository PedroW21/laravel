<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{
    public function __construct(
        protected Support $model
    ) {
    }

    public function getAll(string $filter = null): array
    {
        return $this->model
            // ->where('subject', $filter) # poderia passar varios where's, mas como pode ser nulo, faremos a função
            ->where(function ($query) use ($filter) { // a $query é a query do eloquent, o where é do eloquent, o use é para usar a variavel $filter que está fora do escopo da função
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->get() // can't be all(), we should use get()
            ->toArray();
    }

    public function findOne(string $id): stdClass | null
    {
        $support = $this->model->find($id); // transforma o array em objeto

        if (!$support) return null;

        return (object) $support->toArray();
    }

    public function new(CreateSupportDTO $dto): stdClass
    {
        $support = $this->model->create((array) $dto);
        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): stdClass | null
    {
        $support = $this->model->find($dto->id);

        if (!$support) return null;

        $support->update(
            (array) $dto
        );

        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete(); // findOrFail = se não encontrar, retorna um erro 404
    }
}
