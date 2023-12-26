<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    # inversão de dependencia, onde não interessa a implementação, mas sim a interface
    # não dependemos do tipo de retorno de x,y,z, pois definimos na interface oq deve ser retornado
    public function __construct(
        protected SupportRepositoryInterface $repository // injeta a dependencia de SupportRepositoryInterface 
    ) {
    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass | null // stdClass é uma classe do php que permite criar objetos sem a necessidade de criar uma classe
    {
        return $this->repository->findOne($id);
    }

    /* 
        public function new(    
            string $subject,
            string $status,
            string $body): stdClass
        {...}
        em vez de ter que lidar com n parametros aqui, injeta-se um DTO

    */
    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass | null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
