<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class XenditController extends Controller
{
    private $token = 'xnd_production_ERRXoEh6KiQLisCaNSrFHTy6kvf0l2Olra3JfXqnvKa8wXWeZXrYXqxUP195w5';

    public function getListVa()
    {
        Xendit::setApiKey($this->token);
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();

        return $getVABanks;
    }

    public function createVa(Request $request)
    {
        $shipping = session('shipping');
        $amount = 0;

        foreach (session('cart') as $detail => $details) {
            if($details['product_id'] == 202101 || $details['product_id'] == 202102 || $details['product_id'] == 202103) {
                if ($details['size'] == 'XXL') {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount'])) + 5000;
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            } else {
                if ($details['size'] == 'OVERSIZE') {
                    $amount = $amount +  ($details['quantity'] * $details['price']);
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            }
        }

        $amount = $amount + $shipping;

        $order_number = session('order_number');
        Xendit::setApiKey($this->token);
        new CarbonTimeZone('Asia/Bangkok');
        $VAparams = [
            "external_id" => $order_number,
            "bank_code" => $request->payment,
            "name" => $request->first_name . ' ' . $request->last_name,
            "expected_amount" => $amount,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true
        ];

        $expiration_time = [
            "timestamp" => Carbon::now()->addDays(1)->timestamp,
            "date" => Carbon::now()->addDays(1)->toDayDateTimeString('Asia/Bangkok'),
            "method" => strtolower($request->payment),
            "type" => "va"
        ];

        session()->put('expiration', $expiration_time);

        $createVA = \Xendit\VirtualAccounts::create($VAparams);

        session()->put('payment', $createVA);

        return $createVA;
    }

    public function checkVA()
    {
        Xendit::setApiKey($this->token);
        $payment = session('payment');
        $id = $payment['id'];

        $checkVA = \Xendit\VirtualAccounts::retrieve($id);

        session()->put('paymentVA', $checkVA);

        return $checkVA;
    }

    public function getFVAPayment()
    {
        Xendit::setApiKey($this->token);
        $payment = session('paymentVA');
        $id = $payment['id'];

        $getFVAPayment = \Xendit\VirtualAccounts::getFVAPayment($id);

        return $getFVAPayment;
    }

    public function createEWallets(Request $request)
    {
        $shipping = session('shipping');
        $amount = 0;

        foreach (session('cart') as $detail => $details) {
            if($details['product_id'] == 202101 || $details['product_id'] == 202102 || $details['product_id'] == 202103) {
                if ($details['size'] == 'XXL') {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount'])) + 5000;
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            } else {
                if ($details['size'] == 'OVERSIZE') {
                    $amount = $amount +  ($details['quantity'] * $details['price']);
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            }
        }

        $amount = $amount + $shipping;

        Xendit::setApiKey($this->token);
        $order_number = session('order_number');

        $ewalletChargeParams = [
            "reference_id" => $order_number,
            "currency" => "IDR",
            "amount" => (int)$amount,
            "checkout_method" => "ONE_TIME_PAYMENT",
            "channel_code" => "$request->payment",
            "channel_properties" => [
                "success_redirect_url" => 'https://seventhirty-id.com/payment-success'
            ],
        ];

        $ovoParams = [
            "reference_id" => $order_number,
            "currency" => "IDR",
            "amount" => (int)$amount,
            "checkout_method" => "ONE_TIME_PAYMENT",
            "channel_code" => "ID_OVO",
            "channel_properties" => [
                "mobile_number" => "+" . strval($request->ovo_number),
                "success_redirect_url" => 'https://seventhirty-id.com/payment-success'
            ],
            "voided_at" => Carbon::now()->addDays(1)->toISOString(),
            "refunded_amount" => 0
        ];

        $expiration_time = [
            "timestamp" => Carbon::now()->addMinutes(30)->timestamp,
            "date" => Carbon::now()->addMinutes(30)->toDayDateTimeString('Asia/Bangkok'),
            "method" => strtolower($request->payment),
            "type" => "ewallets"
        ];

        session()->put('expiration', $expiration_time);

        if ($request->payment == "ID_OVO") {
            $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ovoParams);
        } else {
            $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
        }

        session()->put('payment', $createEWalletCharge);

        return $createEWalletCharge;
    }

    public function geteWallets()
    {
        Xendit::setApiKey($this->token);
        $payment = session('payment');

        $charge_id = $payment['id'];
        $getEWalletChargeStatus = \Xendit\EWallets::getEWalletChargeStatus($charge_id);

        return $getEWalletChargeStatus;

        // dd($getEWalletChargeStatus);
    }

    public function createRetail(Request $request, User $user)
    {
        $amount = 0;
        foreach (session('cart') as $detail => $details) {
            if($details['product_id'] == 202101 || $details['product_id'] == 202102 || $details['product_id'] == 202103) {
                if ($details['size'] == 'XXL') {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount'])) + 5000;
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            } else {
                if ($details['size'] == 'OVERSIZE') {
                    $amount = $amount +  ($details['quantity'] * $details['price']);
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            }
        }

        Xendit::setApiKey($this->token);

        $user = User::where('id', session('LoggedUser'))->select('nama_depan', 'nama_belakang')->get();

        $retailparams = [
            "external_id" => uniqid(),
            "retail_outlet_name" => "ALFAMART",
            "name" => $user[0]['nama_depan'] . ' ' . $user[0]['nama_belakang'],
            "expected_amount" => (int)$amount,
            "is_single_use" => true,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString()
        ];

        $expiration_time = [
            "timestamp" => Carbon::now()->addDays(1)->timestamp,
            "date" => Carbon::now()->addDays(1)->toDayDateTimeString()
        ];

        session()->put('payment', $expiration_time && $retailparams);

        $createFPC = \Xendit\Retail::create($retailparams);

        return $createFPC;
    }

    public function getRetailCode()
    {
        Xendit::setApiKey($this->token);

        $id = '60d71aaa09094fa8b718a5e5';

        $getFPC = \Xendit\Retail::retrieve($id);

        dd($getFPC);
    }

    public function createQR(Request $request)
    {
        $shipping = session('shipping');
        $amount = 0;
        foreach (session('cart') as $detail => $details) {
            if($details['product_id'] == 202101 || $details['product_id'] == 202102 || $details['product_id'] == 202103) {
                if ($details['size'] == 'XXL') {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount'])) + 5000;
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            } else {
                if ($details['size'] == 'OVERSIZE') {
                    $amount = $amount +  ($details['quantity'] * $details['price']);
                } else {
                    $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
                }
            }
        }

        $order_number = session('order_number');

        $amount = $amount + $shipping;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.xendit.co/qr_codes');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "external_id=" . $order_number . "&type=DYNAMIC&callback_url=https://www.seventhirty-id.com/checkQR&amount=" . (int)$amount);
        curl_setopt($ch, CURLOPT_USERPWD, 'xnd_production_ERRXoEh6KiQLisCaNSrFHTy6kvf0l2Olra3JfXqnvKa8wXWeZXrYXqxUP195w5' . ':' . '');

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $expiration_time = [
            "timestamp" => Carbon::now()->addDays(1)->timestamp,
            "date" => Carbon::now()->addDays(1)->toDayDateTimeString('Asia/Bangkok'),
            "method" => strtolower($request->payment),
            "type" => "qris"
        ];

        session()->put('expiration', $expiration_time);

        $result = json_decode(curl_exec($ch), true);

        session()->put('payment', $result);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    public function getQR()
    {
        $payment = session('payment');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.xendit.co/qr_codes/payments?external_id=' . $payment['external_id']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_USERPWD, 'xnd_production_ERRXoEh6KiQLisCaNSrFHTy6kvf0l2Olra3JfXqnvKa8wXWeZXrYXqxUP195w5' . ':' . '');

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public function getPayment()
    {
        $payment = session('payment');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.xendit.co/qr_codes/payments?external_id=' . $payment['external_id']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_USERPWD, 'xnd_production_ERRXoEh6KiQLisCaNSrFHTy6kvf0l2Olra3JfXqnvKa8wXWeZXrYXqxUP195w5' . ':' . '');

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        session()->put('success', $result);

        $array = explode(',', $result);

        foreach($array as $val) {
            $tmp = explode(':', $val);
            $status[$tmp[0]] = $tmp[1];
            $status = str_replace(array('[', '{', '"', '}', ']'), '', $status);
        }

        session()->put('status', $status);
    }
}
