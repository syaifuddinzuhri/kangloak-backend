<?php

namespace App\Repositories\Seller;

use App\Models\SellerAddress;

class SellerAddressRepository
{
    public function index()
    {
        try {
            $query = SellerAddress::with(['seller'])->whereHas('seller', function($q){
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
            $query = SellerAddress::create($payload);
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
            $query = SellerAddress::findOrFail($id);
            $query->update($request->all());
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
            $query = SellerAddress::with(['seller'])->findOrFail($id);
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
            $query = SellerAddress::findOrFail($id)->delete();
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
