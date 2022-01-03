<?php

namespace App\Repositories\Admin;

use App\Models\Seller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SellerRepository
{
    public function getAll()
    {
        try {
            $seller = Seller::all();
            return $seller;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function kyc_verification($request, $id)
    {
        try {
            $query = Seller::findOrFail($id);
            $query->update($request->all());
            return $query;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function account_verification($request, $id)
    {
        try {
            $payload = $request->all();
            $payload['verify_at'] = date('Y-m-d H:i:s');
            $query = Seller::findOrFail($id);

            $query->update($payload);

            return $query;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function account_banned($request, $id)
    {
        try {
            $payload = $request->all();
            $payload['banned_at'] = date('Y-m-d H:i:s');
            $query = Seller::findOrFail($id);

            $query->update($payload);

            return $query;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function show($id)
    {
        try {
            $seller = Seller::find($id);
            return $seller;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
