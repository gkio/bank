<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Http\Controllers\API\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * @param $customerId
     * @param $amount
     * @return \Illuminate\Http\JsonResponse
     */
    public function new_transaction($customerId, $amount)
    {
        if(empty($customerId) || empty($amount))
            return response()
                    ->json(['status' => 'must be filled customer id and the amount']);

        $transaction = $this->_new_transaction($customerId, $amount);


        return response()
            ->json([
                'transactionId' => $transaction->id,
                'customerId' => (int)$transaction->customerId,
                'amount' => $transaction->amount,
                'date' => $transaction->created_at,
            ]);
    }

    /**
     * @param $customerId
     * @param $transactionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function find_transaction($customerId, $transactionId)
    {
        if(empty($customerId) || empty($transactionId))
            return response()
                ->json(['status' => 'must be filled customer id and the transaction id']);


        $transaction = $this->_get_transaction([
                ['transactionId','=',$transactionId],
                ['customerId','=',$customerId],
            ]);


        return response()
            ->json([
                'transactionId' => $transaction->transactionId,
                'customerId' => (int)$transaction->customerId,
                'amount' => $transaction->amount,
                'date' => $transaction->created_at,
            ]);

    }

    /**
     * @param $customerId
     * @param $amount
     * @param $date
     * @param $offset
     * @param $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter_transactions($customerId, $amount, $date, $offset, $limit)
    {
        if( empty($customerId) ||
            empty($amount) ||
            empty($date)
        )
            return response()
                ->json(['status' => 'not all fields are submit']);

        $dates = explode('-', $date);

        $time = Carbon::create($dates[0], $dates[1], $dates[2]);

        $transactions = $this->_filtered_transactions(
            [
                ['customerId','=', $customerId],
                ['amount','=', $amount]
            ],
            $time,
            $offset,
            $limit
        );

        return response()
            ->json([
                'transactions' => $transactions,
            ]);
        
    }

    public function update_transaction($transactionId, $amount)
    {
        return response()
            ->json([
                'transaction' => $this->_update_transaction($transactionId, $amount)
            ]);
    }

    /**
     * @param $transactionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_transaction($transactionId)
    {
        return response()
            ->json([
                'status' => Transaction::where('transactionId','=', $transactionId)
                    ->delete()
                    ? 'The transaction with id '. $transactionId .' deleted successfully'
                    : 'ups something gone wrong'
            ]);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
     */
    private function _get_transaction($query){
        return Transaction::where($query)->first();
    }

    /**
     * @param $customerId
     * @param $amount
     * @return Transaction
     */
    private function _new_transaction($customerId, $amount){
        $transaction = new Transaction();

        $transaction->customerId = $customerId;
        $transaction->amount = $amount;
        $transaction->save();

        return $transaction;
    }

    /**
     * @param $query
     * @param $date
     * @param int $offset
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    private function _filtered_transactions($query, $date, $offset = 0, $limit = 10){
        return Transaction::where($query)
                ->whereDate('created_at','>=',$date->startOfDay()->toDateString())
                ->whereDate('created_at','<=',$date->endOfDay()->toDateString())
                ->skip($offset)
                ->take($limit)
                ->get();
    }

    private function _update_transaction($transactionID, $amount){

        Transaction::where('transactionId', '=', $transactionID)
                    ->update(['amount' => $amount]);

        return Transaction::where('transactionId',$transactionID)->first();

    }

}
