<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{
    public function all();

    public function create(array $request);

    public function update(array $request, int$id);
    public function delete(int$id);
}
