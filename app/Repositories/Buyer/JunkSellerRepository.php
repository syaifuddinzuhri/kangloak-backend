<?php

namespace App\Repositories\Buyer;

use App\Models\JunkSeller;

class JunkSellerRepository
{
    public function index()
    {
        try {
            $query = JunkSeller::with(['junk.junk_category', 'seller', 'seller_address'])->get();
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
}
