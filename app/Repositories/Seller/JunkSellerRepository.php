<?php

namespace App\Repositories\Seller;

use App\Models\JunkSeller;
use App\Constant\UploadPathConstant;
use App\Traits\ImageHandlerTrait;

class JunkSellerRepository
{
    public function index()
    {
        try {
            $query = JunkSeller::with(['junk.junk_category', 'seller', 'seller_address'])->whereHas('seller', function ($q) {
                $q->where('id', auth('seller')->user()->id);
            })->get();
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function store($request)
    {
        try {
            $payload = $request->all();
            $payload['seller_id'] = auth('seller')->user()->id;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::JUNK);
                $payload['image'] = $file_name;
            }

            $query = JunkSeller::create($payload);
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
            $query = JunkSeller::find($id);
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $exp = explode('/', $query->image);
                ImageHandlerTrait::unlinkImage(UploadPathConstant::JUNK, end($exp));

                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::JUNK);
                $payload['image'] = $file_name;
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
            $query = JunkSeller::with(['seller', 'seller_address', 'junk.junk_category'])->findOrFail($id);
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
            $query = JunkSeller::find($id);

            $exp = explode('/', $query->image);
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
