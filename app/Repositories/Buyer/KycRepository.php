<?php

namespace App\Repositories\Buyer;

use App\Models\Buyer;
use Exception;
use Illuminate\Http\Request;
use App\Traits\ImageHandlerTrait;
use App\Constant\UploadPathConstant;

class KycRepository
{

    public function getAll()
    {
        try {
            //
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function store($request)
    {
        try {
            $payload = $request->all();
            $query = Buyer::find(auth('buyer')->user()->id);

            if ($request->hasFile('ktp')) {
                $file = $request->file('ktp');
                $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::KTP);
                $payload['ktp'] = $file_name;
            }
            if ($request->hasFile('selfie_ktp')) {
                $file2 = $request->file('selfie_ktp');
                $file_name2 = ImageHandlerTrait::uploadImage($file2,  UploadPathConstant::SELFIE_KTP);
                $payload['selfie_ktp'] = $file_name2;
            }

            $query->update($payload);

            return $query;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function update($request, $id)
    {
        try {
            //
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function show($id)
    {
        try {
            //
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function delete($id)
    {
        try {
            //
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
