<?php

namespace App\Repositories\Admin;

use App\Constant\UploadPathConstant;
use App\Models\Payment;
use App\Models\Buyer;
use App\Models\Mutation;
use App\Traits\ImageHandlerTrait;

class PaymentRepository
{
    use ImageHandlerTrait;

    public function index()
    {
        try {
            $query = Payment::with(['buyer', 'payment_account'])->get();
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
            $query = Payment::with(['buyer', 'payment_account'])->findOrfail($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function confirmation_payment($request, $id)
    {
        try {
            $payload = $request->all();
            $query = Payment::with(['buyer', 'payment_account'])->find($id);
            $buyer = Buyer::find($query->buyer_id);
            if ($payload['status_payment'] == 'REFUND') {
                $query->update(['status' => 'REFUND']);
            } else if ($payload['status_payment'] == 'WAITING') {
                $query->update(['status' => 'WAITING']);
            } else {
                $query->update(['status' => 'PAID']);
                $payload = $request->only(['status']);
                $payload['payment_id'] = $id;
                $payload['amount'] = $query->nominal_pay;
                $payload['buyer_id'] = $query->buyer_id;
                Mutation::insert($payload);

                $buyer->update([
                    'balance' => $buyer->balance + $query->nominal_pay
                ]);
            }

            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
