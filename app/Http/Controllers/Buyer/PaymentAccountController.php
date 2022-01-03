<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PaymentAccountRepository;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    private $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $payload = $this->repository->index();
            return response()->success($payload, 'All payment accounts has been successfully obtained');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), $th->getCode());
        }
    }
}
