<?php

namespace App\Http\Controllers;

use App\Models\md_transaction;
use Illuminate\Http\Request;
use App\Services\TransactionService;


class md_transactionsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = (new TransactionService())->create($request->getContent());

        return response()->json($response, $response->status_code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\md_transaction  $md_transaction
     * @return \Illuminate\Http\Response
     */
    public function show(md_transaction $md_transaction)
    {
        $response = (new TransactionService())->show($md_transaction->id_transaction);

        return response()->json($response, $response->status_code);
    }
}
