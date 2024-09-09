<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryInterface
{

    public function all(): Collection|string
    {
        $candidate = Category::all();
        if ($candidate->isEmpty()) {
            return "No User Found";
        }

        return $candidate;
    }


    public function create(array $request)
    {
        return Category::create($request);
    }

    public function delete(int $id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }

    public function update(array $request, int $id)
    {
        $category = Category::find($id);
        $category->update($request);
        return $category;
    }
}
