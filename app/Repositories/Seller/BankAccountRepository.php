<?php

namespace App\Repositories\Seller;

use App\Models\BankAccount;
use Exception;

class BankAccountRepository
{
    public function index()
    {
        try {
            $query = BankAccount::with(['seller'])->where('seller_id', auth('seller')->user()->id)->get();
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
            $payload['seller_id'] = auth('seller')->user()->id;

            $query = BankAccount::create($payload);
            return $query;
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
            $payload['seller_id'] = auth('seller')->user()->id;

            $query = BankAccount::findOrfail($id);
            $query->update($payload);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function detail($id)
    {
        try {
            $query = BankAccount::with(['seller'])->findOrFail($id);
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
            $query = BankAccount::find($id);
            if (!$query) {
                throw new Exception('Data tidak ditemukan');
            }
            return $query->delete();
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
