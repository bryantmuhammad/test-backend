<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\md_method_of_payment;
use Illuminate\Http\Request;

class md_method_of_paymentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $response = create_reponse();
        try {
            $md_method_of_payment = md_method_of_payment::create($request->validated());
        } catch (\Exception $e) {
            return response()->json($response, $response->status_code);
        }

        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Payment has been created';
        $response->data         = $md_method_of_payment;

        return response()->json($response, $response->status_code);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\md_method_of_payment  $md_method_of_payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, md_method_of_payment $md_method_of_payment)
    {
        $response = create_reponse();
        try {
            $md_method_of_payment->update($request->validated());
        } catch (\Exception $e) {
            return response()->json($response, $response->status_code);
        }

        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Payment has been updated';
        $response->data         = $md_method_of_payment;

        return response()->json($response, $response->status_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\md_method_of_payment  $md_method_of_payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(md_method_of_payment $md_method_of_payment)
    {
        $response = create_reponse();
        try {
            $md_method_of_payment->delete();
        } catch (\Exception $e) {
            return response()->json($response, $response->status_code);
        }

        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Payment has been deleted';
        $response->data         = $md_method_of_payment;

        return response()->json($response, $response->status_code);
    }
}
