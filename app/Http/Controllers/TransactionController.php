<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\CartItem;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $transaction = new Transaction();


        $transaction->client_id = $request->client_id;
        $transaction->handyman_id = $request->handyman_id;

        $cartItem =  CartItem::find($request->cart_item_id);
            $taskItems = $cartItem->taskItems() ;
            $taskItem = $taskItems->first();
            $transaction->taskItem()->associate($taskItem);
            $transaction->cartItem()->associate($taskItem);
        $transaction->save();

    }

public function setTransactionToPaid(Request $request){
    $transaction = Transaction::find($request->transaction_id);
    $transaction->is_paid = true;
    $transaction->save();
}
public function setTransactionToConfirmed(Request $request){
    $transaction = Transaction::find($request->transaction_id);
    $transaction->is_confirmed = true;
    $transaction->save();
}

public function setTransactionToCompleted(Request $request){
    $transaction = Transaction::find($request->transaction_id);
    $transaction->is_completed = true;
    $transaction->save();
}

public function getTaskItemTransactions($id){
    $taskItem = TaskItem::find($id);
    $transactions = $taskItem->transactions()->get();
    return $transactions;
}
 public function getCartItemTransactions($id){
    $cartItem = CartItem::find($id);
    $transactions = $cartItem->transactions()->get();
    return $transactions;
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
