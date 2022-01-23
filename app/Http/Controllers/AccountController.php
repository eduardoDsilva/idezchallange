<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\AccountRequest;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $accounts = Account::all();

        return response()->json($accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AccountRequest $request, AccountRepository $accountRepository)
    {
        try {
            $accountRepository->saveAccount($request->all());
            return response()->json('ok');
        } catch (\Exception $exception) {
            return response()->json('erro');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Account $account
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Account $account)
    {
        $account = Account::findOrFail($account->id);
        return response()->json($account, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
