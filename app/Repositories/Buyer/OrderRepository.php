<?php

namespace App\Repositories\Buyer;

use App\Constant\UploadPathConstant;
use App\Models\Seller;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\JunkSeller;
use App\Models\Mutation;
use App\Traits\ImageHandlerTrait;
use Exception;

class OrderRepository
{
    use ImageHandlerTrait;

    public function index()
    {
        try {
            $query = Order::with(['buyer', 'junk_seller', 'junk_seller.junk', 'junk_seller.seller', 'junk_seller.seller_address'])
                ->where('buyer_id', auth('buyer')->user()->id)->get();
            // $query = Order::with(['buyer', 'junk_seller' => function($query){
            // $query->with(['junk', 'seller', 'seller_address']);
            // }])->whereHas('buyer', function($q){
            // $q->where('id', auth('buyer')->user()->id);
            // })->get();
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
            $payload['buyer_id'] = auth('buyer')->user()->id;

            JunkSeller::where('id', '!=', $payload['junk_seller_id'])
                ->where('seller_id', $payload['seller_id'])
                ->where('status', '!=', 'FINISHED')
                ->update(['status' => 'WAITING']);
            JunkSeller::find($payload['junk_seller_id'])
                ->update(['status' => 'ONGOING']);

            $query = Order::create($payload);

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
            $query = Order::with(['junk_seller.junk', 'junk_seller.seller'])->find($id);

            // Formula Total Order Price
            $junk_price = $query->junk_seller->junk->price;
            $junk_weight = $query->junk_seller->junk->weight;
            $a = $payload['weight'] / $junk_weight;
            $payload['total'] = $a * $junk_price;

            if ($payload['total'] > auth('buyer')->user()->balance) {
                throw new Exception("Saldo kurang");
            }

            JunkSeller::where('id', '!=', $query->junk_seller_id)
                ->where('seller_id', $query->junk_seller->seller->id)
                ->where('status', '!=', 'FINISHED')
                ->update(['status' => 'READY']);
            JunkSeller::find($query->junk_seller_id)
                ->update(['status' => 'FINISHED']);
            Mutation::create([
                'amount' => $payload['total'],
                'order_id' => $id,
                'status' => 'ORDER'
            ]);
            if ($payload['status'] == 'FINISHED') {
                $buyer = Buyer::findOrfail($query->buyer_id);
                $buyer->update([
                    'balance' => $buyer->balance - $payload['total']
                ]);
                $seller = Seller::findOrfail($query->junk_seller->seller->id);
                $seller->update([
                    'balance' => $seller->balance + $payload['total']
                ]);
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
            $query = Order::with(['buyer', 'junk_seller', 'junk_seller.junk', 'junk_seller.seller', 'junk_seller.seller_address'])
                ->where('buyer_id', auth('buyer')->user()->id)->find($id);
            return $query;
        } catch (\Exception $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function delete($id)
    {
        //
    }
}
