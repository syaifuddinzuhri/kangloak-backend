<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/category', 'Seller\JunkCategoryController@index');
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'junk'], function () use ($router) {
    $router->get('/', 'Admin\JunkController@index');
    $router->get('detail/{id}', 'Admin\JunkController@show');
});


// ADMIN ROUTES
$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->post('login', 'Admin\AuthController@login');

    $router->group(['middleware' => ['auth:admin']], function () use ($router) {
        // Authentication
        $router->post('logout', 'Admin\AuthController@logout');
        $router->get('me', 'Admin\AuthController@me');
        $router->get('refresh', 'Admin\AuthController@refresh');

        $router->group(['prefix' => 'seller'], function () use ($router) {
            $router->get('/', 'Admin\SellerController@index');
            $router->put('kyc-verification/{id}', 'Admin\SellerController@kyc_verification');
            $router->put('account-verification/{id}', 'Admin\SellerController@account_verification');
            $router->put('account-banned/{id}', 'Admin\SellerController@account_banned');
        });
        $router->group(['prefix' => 'buyer'], function () use ($router) {
            $router->get('/', 'Admin\BuyerController@index');
            $router->put('kyc-verification/{id}', 'Admin\BuyerController@kyc_verification');
            $router->put('account-verification/{id}', 'Admin\BuyerController@account_verification');
            $router->put('account-banned/{id}', 'Admin\BuyerController@account_banned');
        });
        $router->group(['prefix' => 'junk-category'], function () use ($router) {
            $router->get('/', 'Admin\JunkCategoryController@index');
            $router->post('/', 'Admin\JunkCategoryController@store');
            $router->get('{id}', 'Admin\JunkCategoryController@show');
            $router->delete('{id}', 'Admin\JunkCategoryController@destroy');
            $router->put('update/{id}', 'Admin\JunkCategoryController@update');
        });
        $router->group(['prefix' => 'junk'], function () use ($router) {
            $router->post('store', 'Admin\JunkController@store');
            $router->put('update/{id}', 'Admin\JunkController@update');
            $router->delete('delete/{id}', 'Admin\JunkController@destroy');
        });
        $router->group(['prefix' => 'order'], function () use ($router) {
            $router->get('/', 'Admin\OrderController@index');
            $router->get('detail/{id}', 'Admin\OrderController@edit');
        });
        $router->group(['prefix' => 'payment-accounts'], function () use ($router) {
            $router->get('/', 'Admin\PaymentAccountController@index');
            $router->get('detail/{id}', 'Admin\PaymentAccountController@edit');
            $router->post('store', 'Admin\PaymentAccountController@store');
            $router->put('update/{id}', 'Admin\PaymentAccountController@update');
            $router->delete('delete/{id}', 'Admin\PaymentAccountController@destroy');
        });
        $router->group(['prefix' => 'payment'], function () use ($router) {
            $router->get('/', 'Admin\PaymentController@index');
            $router->get('detail/{id}', 'Admin\PaymentController@edit');
            $router->put('confirmation/{id}', 'Admin\PaymentController@confirmation');
        });
        $router->group(['prefix' => 'withdrawal'], function () use ($router) {
            $router->get('/', 'Admin\WithdrawalController@index');
            $router->get('detail/{id}', 'Admin\WithdrawalController@edit');
            $router->put('verification/{id}', 'Admin\WithdrawalController@verification');
        });
    });
});


// SELLER ROUTES
$router->group(['prefix' => 'seller'], function () use ($router) {
    $router->post('login', 'Seller\AuthController@login');
    $router->post('login-by-google', 'Seller\AuthController@loginByGoogle');

    $router->group(['middleware' => ['auth:seller']], function () use ($router) {
        // Authentication
        $router->post('logout', 'Seller\AuthController@logout');
        $router->get('me', 'Seller\AuthController@me');
        $router->get('refresh', 'Seller\AuthController@refresh');

        $router->group(['prefix' => 'kyc'], function () use ($router) {
            $router->post('store', 'Seller\SellerController@store');
            $router->put('update/{id}', 'Seller\SellerController@update');
        });
        $router->group(['prefix' => 'address'], function () use ($router) {
            $router->get('/', 'Seller\SellerAddressController@index');
            $router->get('detail/{id}', 'Seller\SellerAddressController@edit');
            $router->post('store', 'Seller\SellerAddressController@store');
            $router->put('update/{id}', 'Seller\SellerAddressController@update');
            $router->delete('delete/{id}', 'Seller\SellerAddressController@destroy');
        });
        $router->group(['prefix' => 'junk-category'], function () use ($router) {
            $router->get('/', 'Seller\JunkCategoryController@index');
            $router->post('/', 'Seller\JunkCategoryController@store');
            $router->get('{id}', 'Seller\JunkCategoryController@show');
            $router->delete('{id}', 'Seller\JunkCategoryController@destroy');
            $router->put('update/{id}', 'Seller\JunkCategoryController@update');
        });
        $router->group(['prefix' => 'orders'], function () use ($router) {
            $router->get('/', 'Seller\OrderController@index');
            $router->get('detail/{id}', 'Seller\OrderController@edit');
            $router->post('store', 'Seller\OrderController@store');
            $router->put('update/{id}', 'Seller\OrderController@update');
            $router->delete('delete/{id}', 'Seller\OrderController@destroy');
        });
        $router->group(['prefix' => 'junks'], function () use ($router) {
            $router->get('/', 'Seller\JunkSellerController@index');
            $router->get('detail/{id}', 'Seller\JunkSellerController@edit');
            $router->post('store', 'Seller\JunkSellerController@store');
            $router->put('update/{id}', 'Seller\JunkSellerController@update');
            $router->delete('delete/{id}', 'Seller\JunkSellerController@destroy');
        });
        $router->group(['prefix' => 'bank-accounts'], function () use ($router) {
            $router->get('/', 'Seller\BankAccountController@index');
            $router->get('detail/{id}', 'Seller\BankAccountController@edit');
            $router->post('store', 'Seller\BankAccountController@store');
            $router->put('update/{id}', 'Seller\BankAccountController@update');
            $router->delete('delete/{id}', 'Seller\BankAccountController@destroy');
        });
        $router->group(['prefix' => 'withdrawal'], function () use ($router) {
            $router->get('/', 'Seller\WithdrawalController@index');
            $router->get('detail/{id}', 'Seller\WithdrawalController@edit');
            $router->post('withdraw', 'Seller\WithdrawalController@store');
        });
    });
});

// BUYER ROUTES
$router->group(['prefix' => 'buyer'], function () use ($router) {
    $router->post('login', 'Buyer\AuthController@login');
    $router->post('login-by-google', 'Buyer\AuthController@loginByGoogle');

    $router->group(['middleware' => ['auth:buyer']], function () use ($router) {
        // Authentication
        $router->post('logout', 'Buyer\AuthController@logout');
        $router->get('me', 'Buyer\AuthController@me');
        $router->get('refresh', 'Buyer\AuthController@refresh');

        $router->group(['prefix' => 'kyc'], function () use ($router) {
            $router->post('store', 'Buyer\BuyerController@store');
            $router->put('update/{id}', 'Buyer\BuyerController@update');
        });
        $router->group(['prefix' => 'payment'], function () use ($router) {
            $router->get('/', 'Buyer\PaymentController@index');
            $router->get('detail/{id}', 'Buyer\PaymentController@show');
            $router->post('store', 'Buyer\PaymentController@store');
            $router->post('upload/{id}', 'Buyer\PaymentController@upload');
            $router->put('update/{id}', 'Buyer\PaymentController@update');
            $router->delete('delete/{id}', 'Buyer\PaymentController@destroy');
        });
        $router->group(['prefix' => 'junk-seller'], function () use ($router) {
            $router->get('/', 'Buyer\JunkSellerController@index');
            $router->get('detail/{id}', 'Buyer\JunkSellerController@edit');
        });
        $router->group(['prefix' => 'orders'], function () use ($router) {
            $router->get('/', 'Buyer\OrderController@index');
            $router->get('detail/{id}', 'Buyer\OrderController@show');
            $router->post('store', 'Buyer\OrderController@store');
            $router->put('update/{id}', 'Buyer\OrderController@update');
            $router->delete('delete/{id}', 'Buyer\OrderController@destroy');
        });
        $router->group(['prefix' => 'payment-accounts'], function () use ($router) {
            $router->get('/', 'Buyer\PaymentAccountController@index');
        });
        $router->group(['prefix' => 'bank-accounts'], function () use ($router) {
            $router->get('/', 'Buyer\BankAccountController@index');
            $router->get('detail/{id}', 'Buyer\BankAccountController@edit');
            $router->post('store', 'Buyer\BankAccountController@store');
            $router->put('update/{id}', 'Buyer\BankAccountController@update');
            $router->delete('delete/{id}', 'Buyer\BankAccountController@destroy');
        });
        $router->group(['prefix' => 'withdrawal'], function () use ($router) {
            $router->get('/', 'Buyer\WithdrawalController@index');
            $router->get('detail/{id}', 'Buyer\WithdrawalController@edit');
            $router->post('withdraw', 'Buyer\WithdrawalController@store');
        });
    });
});
