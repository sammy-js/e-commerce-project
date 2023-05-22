<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mpesa;

class MpesaController extends Controller
{
      public function getAccessToken()
      {
          //LOAD ENVIRONMENT VARIABLES
          $consumer_key = env('MPESA_CONSUMER_KEY');
          $consumer_secret = env('MPESA_CONSUMER_SECRET');
          $env = env('MPESA_ENV');
  
          //GENERATING ACCESS TOKEN
          $url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials' : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, $url);
          $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
          curl_setopt($curl, CURLOPT_HEADER, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          $curl_response = curl_exec($curl);
          $response = json_decode($curl_response);
          return  $response->access_token;
      }
  
      // Lipa na Mpesa Online Payment or STK Push
  
      public function initiateStkPush(Request $request,$totalprice)
      {
          $Amount = $totalprice ;/*$request->input('amount');*/
          $phoneNumber = $request->input('phonenumber');
          $phoneNumber = '254' . (int)$phoneNumber;
          $AccountReference = $phoneNumber;
          $PartyA = $phoneNumber; // This is your phone number,
          //LOAD ENVIRONMENT VARIABLES
          $env = env('MPESA_ENV');
          $access_token = $this->getAccessToken();
          $short_code = env('MPESA_SHORTCODE');
          $pass_key = env('MPESA_PASSKEY');
          $callback_url = env('MPESA_CALLBACK_URL');
          $TransactionDesc = 'SLEEZYTECHS';
          $Timestamp = date('YmdHis');
          $password = base64_encode($short_code . $pass_key . $Timestamp);
  
          //INITIATE STK PUSH
          $url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest' : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
          # header for stk push
          $stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
  
          # initiating the transaction
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header
  
          $curl_post_data = array(
              //Fill in the request parameters with valid values
              'BusinessShortCode' => $short_code,
              'Password' => $password,
              'Timestamp' => $Timestamp,
              'TransactionType' => 'CustomerPayBillOnline',
              'Amount' => $Amount,
              'PartyA' => $PartyA,
              'PartyB' => $short_code,
              'PhoneNumber' => $PartyA,
              'CallBackURL' => $callback_url,
              'AccountReference' => $AccountReference,
              'TransactionDesc' => $TransactionDesc
          );
  
          $data_string = json_encode($curl_post_data);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
          $curl_response = curl_exec($curl);
          $data = json_decode($curl_response);
         
      }
 
}
