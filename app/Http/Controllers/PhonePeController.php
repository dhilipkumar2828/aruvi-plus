<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PhonePeController extends Controller
{
    private $merchantId;
    private $saltKey;
    private $saltIndex;
    private $apiUrl;

    public function __construct()
    {
        $this->merchantId = config('phonepe.merchant_id');
        $this->saltKey = config('phonepe.salt_key');
        $this->saltIndex = config('phonepe.salt_index');
        
        $env = config('phonepe.env');
        if ($env === 'PRODUCTION') {
            $this->apiUrl = 'https://api.phonepe.com/apis/hermes/pg/v1/pay';
        } else {
            $this->apiUrl = 'https://api-preprod.phonepe.com/apis/hermes/pg/v1/pay';
        }
    }

    public function initiatePayment(Order $order)
    {
        $merchantTransactionId = $order->order_number;
        $userId = $order->customer_email;
        $amount = $order->amount * 100; // In Paisa

        $payload = [
            'merchantId' => $this->merchantId,
            'merchantTransactionId' => $merchantTransactionId,
            'merchantUserId' => $userId,
            'amount' => $amount,
            'redirectUrl' => route('phonepe.callback', ['order_id' => $merchantTransactionId]),
            'redirectMode' => 'GET',
            'callbackUrl' => route('phonepe.callback'),
            'mobileNumber' => $order->phone,
            'paymentInstrument' => [
                'type' => 'PAY_PAGE',
            ],
        ];

        $encode = base64_encode(json_encode($payload, JSON_UNESCAPED_SLASHES));
        $string = $encode . '/pg/v1/pay' . $this->saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $this->saltIndex;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $finalXHeader,
        ])->post($this->apiUrl, [
            'request' => $encode,
        ]);

        $res = json_decode($response->getBody(), true);
        
        Log::debug('PhonePe Request URL: ' . $this->apiUrl);
        Log::debug('PhonePe Payload: ' . json_encode($payload, JSON_UNESCAPED_SLASHES));
        Log::debug('PhonePe Encoded Request: ' . $encode);
        Log::debug('PhonePe X-VERIFY: ' . $finalXHeader);
        Log::debug('PhonePe Raw Response: ' . $response->getBody());

        if (isset($res['success']) && $res['success'] === true) {
            $url = $res['data']['instrumentResponse']['redirectInfo']['url'];
            return redirect()->away($url);
        }

        Log::error('PhonePe Payment Initiation Failed: ' . json_encode($res));
        return back()->with('error', 'Unable to initiate payment. Please try again.');
    }

    public function callback(Request $request)
    {
        $input = $request->all();
        Log::info('PhonePe Callback Received: ' . json_encode($input));

        $transactionId = $request->order_id ?? ($input['transactionId'] ?? ($input['merchantTransactionId'] ?? null));

        // If we don't have the ID in the URL, try to find the last pending order
        if (!$transactionId) {
            $lastOrder = Order::where('payment_status', 'pending')
                ->latest()
                ->first();
            
            // If still no order, just get the absolute latest order
            if (!$lastOrder) {
                $lastOrder = Order::latest()->first();
            }
            
            $transactionId = $lastOrder ? $lastOrder->order_number : null;
        }

        if ($transactionId) {
            return $this->checkPaymentStatus($transactionId);
        }

        Log::warning('PhonePe Callback: No Transaction ID found.');
        return redirect()->route('cart.index')->with('error', 'Payment data was lost. Please contact support if amount was debited.');
    }

    private function checkPaymentStatus($transactionId)
    {
        $path = "/pg/v1/status/" . $this->merchantId . "/" . $transactionId;
        $string = $path . $this->saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $this->saltIndex;

        $apiUrl = str_replace('/pay', '', $this->apiUrl) . '/status/' . $this->merchantId . '/' . $transactionId;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $finalXHeader,
            'X-MERCHANT-ID' => $this->merchantId,
        ])->get($apiUrl);

        $res = json_decode($response->getBody(), true);
        Log::info('PhonePe Status Check Response: ' . $response->getBody());

        if (isset($res['success']) && $res['success'] === true && $res['code'] === 'PAYMENT_SUCCESS') {
            $order = Order::where('order_number', $transactionId)->first();
            if ($order) {
                $order->update([
                    'payment_status' => 'paid',
                    'payment_method' => 'PhonePe',
                    'transaction_id' => $res['data']['transactionId'] ?? null,
                ]);

                session()->forget('cart');
                session()->forget('coupon_code');

                return redirect()->route('order.success', ['order' => $order->order_number])
                    ->with('success', 'Payment successful!');
            }
        }

        return redirect()->route('cart.index')->with('error', 'Payment status check failed. Code: ' . ($res['code'] ?? 'Unknown'));
    }
}
