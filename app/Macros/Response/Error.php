<?php

namespace App\Macros\Response;

use App\Macros\Contracts\ResponseMacroContract;

class Error implements ResponseMacroContract
{
    /**
     * Run macro.
     * Semua error by class harus diberikan status code = 400
     * Karena jika code = 500 akan dianggap error laravel, dan hanya bisa dibaca jika env = local dan debug = true
     * @param ResponseFactory $factory
     * @return void
     */
    public function run($factory)
    {
        $factory->macro('error', function ($message = 'bad request', $statusCode = 400) use ($factory) {
            $error_msg = 'Aksi gagal ';

            if ($statusCode == 0) $statusCode = 400;

            if ($statusCode > 599) $statusCode = 500;


            if ($statusCode == 500) {
                $message = (env('APP_ENV') == "local" && env('APP_DEBUG') == "true") ? $error_msg . " [" . $message . "]" : $error_msg;
            }

            return $factory->make([
                'status' => false,
                'message' => $message
            ], $statusCode);
        });
    }
}
