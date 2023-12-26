<?php

namespace App\Services;

use stdClass;

class SupportService
{
    protected $repository;

    public function __construct()
    {
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
    public function new(
        string $subject,
        string $status,
        string $body
    ): stdClass {
        return $this->repository->new($subject, $status, $body);
    }

    public function update(
        string $id,
        string $subject,
        string $status,
        string $body
    ): stdClass | null {
        return $this->repository->update($id, $subject, $status, $body);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
