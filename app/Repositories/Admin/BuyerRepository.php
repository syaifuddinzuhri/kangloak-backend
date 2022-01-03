<?php

namespace App\Repositories\Admin;

use App\Models\Buyer;

class BuyerRepository
{
    public function getAll()
    {
        try {
            $query = Buyer::all();
            return $query;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function kyc_verification($request, $id)
    {
        try {
            $query = Buyer::findOrFail($id);
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
            $query = Buyer::findOrFail($id);

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
            $query = Buyer::findOrFail($id);

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
            $query = Buyer::find($id);
            return $query;
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
