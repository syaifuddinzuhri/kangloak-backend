<?php

namespace App\Repositories\Admin;

use App\Constant\UploadPathConstant;
use App\Models\PaymentAccount;
use App\Traits\ImageHandlerTrait;

class PaymentAccountRepository
{
    use ImageHandlerTrait;

    public function index()
    {
        try {
            $query = PaymentAccount::all();
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
            if ($request->hasFile('qr_code')) {
                $file = $request->file('qr_code');
                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_QR_CODE);
                $payload['qr_code'] = $file_name;
            }

            if ($request->hasFile('logo')) {
                $file2 = $request->file('logo');
                $file_name2 = ImageHandlerTrait::uploadImage($file2,  UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_LOGO);
                $payload['logo'] = $file_name2;
            }

            $query = PaymentAccount::create($payload);
            return $this->show($query);
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function update($request, $id)
    {
        try {
            $payload = $request->all();
            $query = PaymentAccount::find($id);
            if ($request->hasFile('qr_code') ) {
                $file = $request->file('qr_code');

                $exp = explode('/', $query->qr_code);
                ImageHandlerTrait::unlinkImage(UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_QR_CODE, end($exp));

                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_QR_CODE);
                $payload['qr_code'] = $file_name;
            }

            if ($request->hasFile('logo') ) {
                $file2 = $request->file('logo');

                $exp2 = explode('/', $query->logo);
                ImageHandlerTrait::unlinkImage(UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_LOGO, end($exp2));

                $file_name2 = ImageHandlerTrait::uploadImage($file2,  UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_LOGO);
                $payload['logo'] = $file_name2;
            }

            $query->update($payload);
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
            $query = PaymentAccount::find($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function delete($id)
    {
        try {
            $query = PaymentAccount::find($id);

            $exp = explode('/', $query->qr_code);
            $exp2 = explode('/', $query->logo);
            ImageHandlerTrait::unlinkImage(UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_QR_CODE, end($exp));
            ImageHandlerTrait::unlinkImage(UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_LOGO, end($exp2));

            $query->delete();
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
