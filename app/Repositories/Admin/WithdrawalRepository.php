<?php

namespace App\Repositories\Admin;

use App\Models\Withdrawal;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Mutation;
use Exception;

class WithdrawalRepository
{
    public function getAll()
    {
        try {
            $query = Withdrawal::with(['buyer', 'seller', 'bank_account'])->get();
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
            $query = Withdrawal::with(['buyer', 'seller', 'bank_account'])->findOrFail($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function verification_withdrawal($request, $id)
    {
        try {
            $payload = $request->all();
            $query = Withdrawal::with(['buyer', 'seller', 'bank_account'])->findOrFail($id);

            if($payload['status_withdrawal'] == 'WAITING'){
                $query->update(['status' => 'WAITING']);
            }else if($payload['status_withdrawal'] == 'SUCCESS'){
                if($query->buyer_id == '' || $query->buyer_id == null){
                    $seller = Seller::findOrFail($query->seller_id);
                    $seller->update([
                        'balance' => $seller->balance - $query->nominal_pay
                    ]);
                }else{
                    $buyer = Buyer::findOrFail($query->buyer_id);
                    $buyer->update([
                        'balance' => $buyer->balance - $query->nominal_pay
                    ]);
                }
                $payload['withdrawal_id'] = $id;
                $payload['amount'] = $query->nominal_pay;
                $payload = $request->only(['status']);
                Mutation::insert($payload);

                $query->update(['status' => 'SUCCESS']);
            }

            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
