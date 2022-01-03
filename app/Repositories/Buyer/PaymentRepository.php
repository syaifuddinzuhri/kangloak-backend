<?php

namespace App\Repositories\Buyer;

use App\Constant\UploadPathConstant;
use App\Models\Payment;
use App\Models\Mutation;
use App\Traits\ImageHandlerTrait;
use Carbon\Carbon;
use Exception;

class PaymentRepository
{
    use ImageHandlerTrait;

    public function index()
    {
        try {
            $query = Payment::with(['buyer', 'payment_account'])->where('buyer_id', auth('buyer')->user()->id)->get();
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
            // return $payload;
            // if ($request->hasFile('payment_slip')) {
            //     $file = $request->file('payment_slip');
            //     $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::PAYMENT_SLIP);
            //     $payload['payment_slip'] = $file_name;
            // }

            $fee = 0;
            $payload['no_trx'] = $this->invoiceNumber();
            $payload['buyer_id'] = auth('buyer')->user()->id;
            $payload['nominal_fee'] = $fee;
            $payload['uniq_num'] = rand(0, 999);
            $payload['nominal_pay'] = $payload['nominal'] + $payload['uniq_num'];
            $payload['date'] = Carbon::now();

            $query = Payment::create($payload);

            // $payload['payment_id'] = $query->id;
            // $payload['amount'] = $payload['nominal_pay'];
            // Mutation::insert(array_merge(['status' => 'DEPOSIT'], $payload));
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function invoiceNumber()
    {
        $latest = Payment::latest()->first();

        if (!$latest) {
            return 'PY0001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->no_trx);

        return 'PY' . sprintf('%04d', $string + 1);
    }

    public function detail($id)
    {
        try {
            $payment = Payment::with('payment_account')->find($id);
            return $payment;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function upload($request, $id)
    {
        try {
            $payment = Payment::find($id);
            if ($request->hasFile('payment_slip')) {
                $file = $request->file('payment_slip');
                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::PAYMENT_SLIP);
                $payment->update([
                    'payment_slip' => $file_name
                ]);
                return $payment;
            }
            throw new Exception("File harus diisi");
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
