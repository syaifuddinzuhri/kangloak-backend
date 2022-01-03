<?php

namespace App\Repositories\Seller;

use App\Models\Withdrawal;
use App\Models\Seller;
use Exception;

class WithdrawalRepository
{
    public function getAll()
    {
        try {
            $query = Withdrawal::with(['seller', 'bank_account'])->where('seller_id', auth('seller')->user()->id)->get();
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
            $query = Withdrawal::with(['seller', 'bank_account'])->findOrFail($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function withdraw($request)
    {
        try {
            $payload = $request->all();
            $seller = Seller::findOrfail(auth('seller')->user()->id);

            $fee = 0;
            $payload['seller_id'] = auth('seller')->user()->id;
            $payload['nominal_fee'] = $fee;
            $payload['nominal_pay'] = $payload['nominal'] + $fee;
            if($seller->balance <= $payload['nominal']){
                throw new Exception("Nominal withdraw tidak boleh kurang atau sama dengan balance!");
            }

            $query = Withdrawal::create($payload);

            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
