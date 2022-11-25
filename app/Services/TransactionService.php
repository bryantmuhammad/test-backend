<?php

namespace App\Services;

use App\Models\md_transaction;
use App\Models\md_stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TransactionService
{
    public function create($request)
    {
        $response = create_reponse();
        $request = json_decode($request);

        DB::beginTransaction();
        try {
            $id_transaction = Str::random(10);
            $products = [];
            foreach ($request->transaction as $transaction) {
                $produk = md_stock::where('id_product', $transaction->id_product)->firstOrFail();
                if ($transaction->total_bought > $produk->stok) {
                    throw new \Exception("Stok produk {$produk->id_product} tidak cukup.");
                }

                $stokNow = $produk->stok - $transaction->total_bought;
                $produk->update(['stok' => $stokNow]);
                $products[] = [
                    'id_transaction'        => $id_transaction,
                    'id_product'            => $transaction->id_product,
                    'id_method_of_payment'  => $request->id_method_of_payment,
                    'user_id'               => auth()->user()->id,
                    'total_bought'          => $transaction->total_bought
                ];
            }

            $transactions = md_transaction::insert($products);
        } catch (\Exception $e) {
            DB::rollBack();
            $response->message = $e->getMessage();
            return $response;
        }

        DB::commit();
        $response->status_code  = 200;
        $response->status       = 'success';
        $response->message      = 'Transaction has been made';
        $response->data         = $transactions;

        return $response;
    }

    public function show($id_transaction)
    {
        $response = create_reponse();
        $transactions = md_transaction::with('user', 'payment', 'produk')->where('id_transaction', $id_transaction)->get();
        $list_transaction = [];
        foreach ($transactions as $transaction) {
            $list_transaction['product'][] = [
                'id_product'    => $transaction->id_product,
                'total_bought'  => $transaction->total_bought
            ];

            $list_transaction['id_method_of_payment']   = $transaction->payment->id_method_of_payment;
            $list_transaction['name_payment']           = $transaction->payment->name_method_of_payment;
        }

        $response->data         = $list_transaction;
        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Transaction Detail';

        return $response;
    }
}
