<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PaymentController extends Controller
{
    private function initSTK($phone)
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
            'PartyA' => $phone,
            'PartyB' => $short_code,
            'PhoneNumber' => $phone,
            'CallBackURL' => config('mpesa.callback_url'),
            'AccountReference' => '123',
            'TransactionDesc' => 'Nothing here'
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return $curl_response;
    }

     private function getPassword($shortCode, $passkey, $time)
    {
        return base64_encode($shortCode . $passkey . $time);
    }


    public function initPayment(Request $request)
    {
    	if ($request->payment == 'mpesa' ) {
    		$this->initSTK($request->phone);
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
}
