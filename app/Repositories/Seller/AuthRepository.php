<?php

namespace App\Repositories\Seller;

use App\Models\Buyer;
use App\Models\Seller;
use App\Services\FirebaseService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthRepository
{

    public function login($request)
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if (!$token = auth('seller')->attempt($credentials)) {
                throw new Exception("Email or password is wrong!", 401);
            };
            $jwt = auth('seller')->payload()->toArray();
            $data = auth('seller')->user();
            $data['token'] = $token;
            $data['exp_token'] = $jwt['exp'];
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function loginByGoogle($request)
    {
        try {
            $firebase = new FirebaseService();
            $response = $firebase->getSpesificUser($request->uid, $request->email);
            $seller = Seller::where('email', $response->email)->first();
            if ($seller) {
                $seller->update([
                    'firebase_uid' => $response->uid,
                    'google_pic' => $response->photoUrl
                ]);
                if ($seller->is_banned) {
                    throw new Exception("This account has been banned!", 401);
                }
                $token =  auth('seller')->login($seller);
            } else {
                $buyer = Buyer::where('email', $response->email)->first();
                if ($buyer) {
                    throw new Exception("Anda sudah terdaftar sebagai buyer");
                }
                $new_seller = Seller::create([
                    'name' => $response->displayName,
                    'email' => $response->email,
                    'phone' => $response->phoneNumber,
                    'google_pic' => $response->photoUrl,
                    'firebase_uid' => $response->uid,
                    // 'fbase_device_token' => $request->fbase_device_token,
                ]);
                $token =  auth('seller')->login($new_seller);
            }
            $data = $this->me();
            $data['token'] = $token;
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function me()
    {
        try {
            $data = auth('seller')->user();
            $data['rule'] = 'seller';
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function logout()
    {
        try {
            return auth('seller')->logout();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function refresh()
    {
        try {
            return auth('seller')->parseToken()->refresh();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
