<?php

namespace App\Repositories\Admin;

use App\Models\Order;

class OrderRepository
{
    public function getAll()
    {
        try {
            $query = Order::with(['buyer', 'junk_seller' => function ($query) {
                $query->with(['junk.junk_category', 'seller', 'seller_address']);
            }])->get();
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
            $query = Order::with(['buyer', 'junk_seller' => function ($query) {
                $query->with(['junk', 'seller', 'seller_address']);
            }])->findOrFail($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
