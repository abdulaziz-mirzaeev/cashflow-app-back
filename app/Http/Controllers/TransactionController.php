<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Transaction::all());
    }

    public function expenses()
    {
        return response(Transaction::where('type', Transaction::TYPE_EXPENSE)->get());
    }

    public function income()
    {
        return response(Transaction::where('type', Transaction::TYPE_INCOME)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     */
    public function store(TransactionRequest $request)
    {
        $validated = $request->validated();

        $transaction = Transaction::create([
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'comment' => $validated['comment'],
            'currency' => $validated['currency'] ?? Transaction::CURRENCY_USD,
        ]);

        return response($transaction);

    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function show(Transaction $transaction)
    {
        return response($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TransactionRequest $request
     * @param Transaction $transaction
     * @return Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $validated = $request->validated();

        return response(
            $transaction->update([
                'type' => $validated['type'],
                'amount' => $validated['amount'],
                'comment' => $validated['comment'],
                'currency' => $validated['currency'],
            ])
        );


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response(['status' => 'success']);
    }
}
