<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::paginate(10);
    }

    public function getById($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $Category = $this->getById($id);
        $Category->update($data);
        return $Category;
    }

    public function delete($id)
    {
        $Category = $this->getById($id);
        $Category->delete();
    }
}