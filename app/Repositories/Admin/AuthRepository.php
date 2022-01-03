<?php

namespace App\Repositories\Admin;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthRepository
{

    public function login($request)
    {
        try {
            $credentials = $request->only(['username', 'password']);
            if (!$token = auth('admin')->attempt($credentials)) {
                throw new Exception("Username or password is wrong!", 401);
            };
            $jwt = auth('admin')->payload()->toArray();
            $data = auth('admin')->user();
            $data['token'] = $token;
            $data['exp_token'] = $jwt['exp'];
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
            return auth('admin')->user();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function logout()
    {
        try {
            return auth('admin')->logout();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function refresh()
    {
        try {
            return auth('admin')->parseToken()->refresh();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
