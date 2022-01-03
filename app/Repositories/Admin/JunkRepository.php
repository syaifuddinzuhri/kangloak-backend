<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use App\Models\Junk;
use App\Constant\UploadPathConstant;
use App\Traits\ImageHandlerTrait;

class JunkRepository
{
    public function getAll()
    {
        try {
            $junk = Junk::with(['junk_category'])->get();
            return $junk;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function create($request)
    {
        try {
            $payload = $request->all();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::JUNK);
                $payload['photo'] = $file_name;
            }

            $query = Junk::create($payload);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function update($request, $id)
    {
        try {
            $payload = $request->all();
            $query = Junk::findOrFail($id);
            if ($request->hasFile('photo') ) {
                $file = $request->file('photo');

                $exp = explode('/', $query->photo);
                ImageHandlerTrait::unlinkImage(UploadPathConstant::JUNK, end($exp));

                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::JUNK);
                $payload['photo'] = $file_name;
            }

            $query->update($payload);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function show($id)
    {
        try {
            $query = Junk::with(['junk_category'])->findOrFail($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function delete($id)
    {
        try {
            $query = Junk::find($id);
            $exp = explode('/', $query->photo);
            ImageHandlerTrait::unlinkImage(UploadPathConstant::JUNK, end($exp));

            $query->delete();
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
