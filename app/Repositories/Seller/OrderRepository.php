<?php

namespace App\Repositories\Seller;

use App\Constant\UploadPathConstant;
use App\Models\Order;
use App\Traits\ImageHandlerTrait;

class OrderRepository
{
    use ImageHandlerTrait;

    public function index()
    {
        try {
            $data = Order::with(['buyer', 'junk_seller.junk', 'junk_seller.seller', 'junk_seller.seller_address'])
                ->whereHas('junk_seller', function ($q) {
                    $q->where('seller_id', auth('seller')->user()->id);
                })->get();

            // $query = Order::with(['buyer', 'junk_seller' => function ($query) {
            //     $query->with(['junk', 'seller', 'seller_address']);
            // }])->whereHas('buyer', function ($q) {
            //     $q->where('id', auth('buyer')->user()->id);
            // })->get();

            return $data;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function store($request)
    {
        //
    }

    public function update($request, $id)
    {
        //
    }

    public function show($id)
    {
        try {
            $query = Order::with(['buyer', 'junk_seller.junk', 'junk_seller.seller', 'junk_seller.seller_address'])
                ->where('id', auth('seller')->user()->id)
                ->findOrFail($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function delete($id)
    {
        //
    }
}
