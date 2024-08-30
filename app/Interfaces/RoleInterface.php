<?php

namespace App\Interfaces;

interface RoleInterface
{
    public function all();

//    public function getById(int$id);

    public function create(array $request);
    public function update(array $request, int $id);
    public function delete(int$id);
}
