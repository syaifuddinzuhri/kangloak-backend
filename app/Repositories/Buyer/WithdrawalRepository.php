<?php

namespace App\Repositories\Buyer;

use App\Models\Withdrawal;
use App\Models\Buyer;
use Exception;

class WithdrawalRepository
{
    public function getAll()
    {
        try {
            $query = Withdrawal::with(['buyer', 'bank_account'])->where('buyer_id', auth('buyer')->user()->id)->get();
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
            $query = Withdrawal::with(['buyer', 'bank_account'])->findOrFail($id);
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
            $buyer = Buyer::findOrfail(auth('buyer')->user()->id);

            $fee = 0;
            $payload['buyer_id'] = auth('buyer')->user()->id;
            $payload['nominal_fee'] = $fee;
            $payload['nominal_pay'] = $payload['nominal'] + $fee;
            if($buyer->balance <= $payload['nominal']){
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
