<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private function initSTK(Payment $payment)
    {
        $urlNew = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $access_token = $this->getCred();

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $urlNew);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization:Bearer $access_token",
            'Content-Type:application/json'
        ));

        $short_code = config('mpesa.short_code');
        $time = \Carbon\Carbon::now()->format('YmdHis');
        $passkey = config('mpesa.passkey');

        $curl_post_data = array(
            'BusinessShortCode' => $short_code,
            'Password' => $this->getPassword($short_code, $passkey, $time),
            'Timestamp' => $time,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => 1,
            'PartyA' => $payment->phone,
            'PartyB' => $short_code,
            'PhoneNumber' => $payment->phone,
            'CallBackURL' => config('mpesa.callback_url'),
            'AccountReference' => $payment->ref_number,
            'TransactionDesc' => 'Nothing here'
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return json_decode($curl_response);
    }

    private function getPassword($shortCode, $passkey, $time)
    {
        return base64_encode($shortCode . $passkey . $time);
    }

    public function initPayment(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        $payment->status = 'initialized';
        $payment->save();
        $stkResponse = null;
    	if ($request->payment == 'mpesa' ) {
    		$stkResponse = $this->initSTK($payment);
    		if ($stkResponse->ResponseCode == '0') {
    		    $payment->mpesa_merchant_request_id = $stkResponse->MerchantRequestID;
    		    $payment->save();
            }
    	}

        flash('Your payment process has been initialized please pay and hit "confirm payment"')->info();

    	return response()->json([
    	    'success' => true,
        ]);
    }

    public function confirmPayment(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        if ($payment->status == 'paid') {
            flash("shipment cons number $payment->ref_number has been paid for")->success();
            return response()->json([
                'success' => true,
                'redirect' => url('Client/requests')
            ]);
        } else {
            $status = str_replace('-', ' ', $payment->status);
            flash("payment status is $status please re-initialize payment")->warning();
            return response()->json([
                'success' => true
            ]);
        }
    }

    private function getCred()
    {
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $key = config('mpesa.consumer_key');
        $secret = config('mpesa.consumer_secret');
       // dd(config('mpesa'));
        $credentials = base64_encode($key . ':' . $secret);
        // dd($credentials);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Accept: application/json',
            'Authorization: Basic '.$credentials
        )); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // dd($curl);
        $curl_response = curl_exec($curl);
        // curl_close($curl);
        // dd($curl_response);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = substr($curl_response, 0, $header_size);
        $body = substr($curl_response, $header_size);
        curl_close($curl);
      
        return $access_token = json_decode($body)->access_token;
    }

    public function handleCallback($payment_method)
    {
        $this->handleMpesaSTKCallback();
    }

    private function handleMpesaSTKCallback()
    {
        $postData = file_get_contents('php://input');

        $data = json_decode($postData, false);

        \Log::info($postData);

        $payment = Payment::where('mpesa_merchant_request_id', $data->Body->stkCallback->MerchantRequestID)->first();

        if ($data->Body->stkCallback->ResultCode == 0) {
            $payment->status = 'paid';
        } elseif($data->Body->stkCallback->ResultCode == 1001) {
            $payment->status = 'timed-out';
        } elseif ($data->Body->stkCallback->ResultCode == 1032) {
            $payment->status = 'cancelled';
        }

        $payment->save();
    }
}
