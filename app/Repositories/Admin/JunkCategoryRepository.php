<?php

namespace App\Repositories\Admin;

use App\Models\JunkCategory;
use Exception;
use Illuminate\Http\Request;

class JunkCategoryRepository
{

    public function getAll()
    {
        try {
            $category = JunkCategory::all();
            return $category;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function create($request)
    {
        try {
            $query = JunkCategory::create($request->all());
            return $query;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function update($request, $id)
    {
        try {
            $query = JunkCategory::find($id);
            $query->update($request->all());
            return $query;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function show($id)
    {
        try {
            $category = JunkCategory::find($id);
            return $category;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function delete($id)
    {
        try {
            $data = JunkCategory::find($id);
            if (!$data) {
                throw new Exception("Data not found");
            }
            return $data->delete();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
