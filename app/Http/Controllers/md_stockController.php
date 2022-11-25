<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\md_stock;
use Illuminate\Http\Request;

class md_stockController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockRequest $request)
    {
        $response = create_reponse();
        try {
            $md_stock = md_stock::create($request->validated());
        } catch (\Exception $e) {
            return response()->json($response, $response->status_code);
        }

        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Produk has been created';
        $response->data         = $md_stock;

        return response()->json($response, $response->status_code);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\md_stock  $md_stock
     * @return \Illuminate\Http\Response
     */
    public function update(StockRequest $request, md_stock $md_stock)
    {
        $response = create_reponse();
        try {
            $md_stock = $md_stock->update($request->validated());
        } catch (\Exception $e) {
            return response()->json($response, $response->status_code);
        }

        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Produk has been updated';
        $response->data         = $md_stock;

        return response()->json($response, $response->status_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\md_stock  $md_stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(md_stock $md_stock)
    {
        $response = create_reponse();
        try {
            $md_stock->delete();
        } catch (\Exception $e) {
            return response()->json($response, $response->status_code);
        }

        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Produk has been deleted';
        $response->data         = $md_stock;

        return response()->json($response, $response->status_code);
    }
}
