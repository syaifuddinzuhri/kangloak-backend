<?php

namespace App\Repositories\Seller;

use App\Models\JunkCategory;

class JunkCategoryRepository
{

    public function getAll()
    {
        try {
            $category = JunkCategory::all();
            return $category;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function create()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function show()
    {
        # code...
    }

    public function delete()
    {
        # code...
    }
}
