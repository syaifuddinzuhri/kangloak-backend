<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\BuyerRepository;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    private $repository;

    public function __construct(BuyerRepository $repository)
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
            $payload = $this->repository->getAll();
            return response()->success($payload, 'All buyer has been successfully obtained');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function kyc_verification(Request $request, $id)
    {
        try {
            $payload = $this->repository->kyc_verification($request, $id);
            return response()->success($payload, 'KTP verification successful');
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function account_verification(Request $request, $id)
    {
        try {
            $payload = $this->repository->account_verification($request, $id);
            return response()->success($payload, 'Account verification successful');
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }

    public function account_banned(Request $request, $id)
    {
        try {
            $payload = $this->repository->account_banned($request, $id);
            return response()->success($payload, 'Account banned successful');
        } catch (\Throwable $th) {
            throw $th;
            report($th);
            return $th;
        }
    }
}
