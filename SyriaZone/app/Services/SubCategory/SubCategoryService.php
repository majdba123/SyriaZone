<?php

namespace App\Services\SubCategory;

use App\Models\Sub_Categort;

class SubCategoryService
{
    public function getAll()
    {
        return Sub_Categort::all();
    }

    public function getById($id)
    {
        return Sub_Categort::findOrFail($id); // يرجع الخطأ 404 إذا لم يتم العثور
    }

    public function store(array $data)
    {
        return Sub_Categort::create($data);
    }

    public function update(Sub_Categort $subcategory, array $data)
    {
        $subcategory->update($data);
        return $subcategory;
    }

    public function delete(Sub_Categort $subcategory)
    {
        return $subcategory->delete();
    }
}
