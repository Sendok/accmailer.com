<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\DB;
use Response;
use App\Helpers\SessionHelper;

class PaymentController extends Controller
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;
    protected $user;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
        $this->user = new SessionHelper;
    }
    
    // payment gateway function
    public function payment(Request $request){
        $date = date('Y-m-d H:i:s');
        $user = $this->user->getUser();
        $user_id = $user->id;
        $plan_id = $request->input("plan_id");
        $getPlan = DB::select("select * from plan where id = ".$plan_id."");
        $price = $getPlan[0]->amount;
        $plan_name = $getPlan[0]->name;
        $method = $request->input("payment-method");
        if($plan_id == 1){
            $method = 'free';
        }
        $invoice_number = $user_id."".$plan_id."".strtotime($date);
        $desc = "Order #{$invoice_number} Invoice Plan ".$plan_name;
        //create invoice
        DB::table('invoice')->insert([
            'invoice_number' => $invoice_number,
            'plan_id' => $plan_id,
            'user_id' => $user_id,
            'status' => 'payment-process',
            'price' => $price,
            'is_recurring' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        $getInvoice = DB::select("select * from invoice where invoice_number = ".$invoice_number."");
        $invoice_id = $getInvoice[0]->id;
        //method payment for paypal
        if($method == 'paypal'){
            $data = [];
        
            $data['items'] = [
                [
                    'name' => 'Plan'.$plan_name,
                    'price' => $price,
                    'desc'  => $desc,
                    'qty' => 1
                ]
            ];
    
            $data['invoice_id'] = $invoice_number;
            $data['invoice_description'] = $desc;
            $data['return_url'] = 'http://localhost:8000/payment/success';
            $data['cancel_url'] = 'http://localhost:8000/payment/cancel';
            $data['total'] = $price;
            
            $response = $this->provider->setExpressCheckout($data);
            $response = $this->provider->setExpressCheckout($data, true);
            // create transaction 
            
            DB::table('payment_transaction')->insert([
                'invoice_id' => $invoice_id,
                'invoice_number' => $invoice_number,
                'status' => 'payment-process',
                'method' => $method,
                'created_at' => $date,
                'updated_at' => $date
            ]);
            
            return redirect($response['paypal_link']);
        } else 
        // method payment for midtrans
        if($method == 'midtrans'){
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY','');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            //midtrans payment methods
            $data = 
            [
                'transaction_details' => [
                    'order_id' => $invoice_number,
                    'gross_amount' => $price,
                ],
                'item_details' => [
                    [
                        'id' => $invoice_number,
                        'price' => $price,
                        'quantity' => 1,
                        'name' => $desc,
                    ]
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email
                ]
            ];
            // create transaction 
            DB::table('payment_transaction')->insert([
                'invoice_id' => $invoice_id,
                'invoice_number' => $invoice_number,
                'status' => 'payment-process',
                'method' => $method,
                'created_at' => $date,
                'updated_at' => $date
            ]);
            // update invoice status
            DB::update(
                'update invoice set status = "payment-process" where id = ?',
                [$invoice_id]
            );
            
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($data)->redirect_url;
            return redirect($paymentUrl);
        } else {
            //invoice
            //insert transaction
            DB::table('payment_transaction')->insert([
                'invoice_id' => $invoice_id,
                'invoice_number' => $invoice_number,
                'status' => 'success',
                'method' => 'free',
                'created_at' => $date,
                'updated_at' => $date
            ]);
            // update invoice status
            DB::update(
                'update invoice set status = "success" where id = ?',
                [$invoice_id]
            );
            //user plan
            DB::table('user_plan')->insert([
                'plan_id' => $plan_id,
                'start_at' => $date,
                'user_id' => $user_id
            ]);
            //redirect
            return redirect()->route('single');
        }
    }
    // update all transaction success
    public function updateSuccessPayment($invoice_number){
        $date = date('Y-m-d H:i:s');
        //update transaction
        DB::update(
            'update payment_transaction set status = "success" where invoice_number = ?',
            [$invoice_number]
        );
        // update invoice status
        DB::update(
            'update invoice set status = "success" where invoice_number = ?',
            [$invoice_number]
        );
        
        $invoice = DB::select("SELECT * FROM invoice where invoice_number = ".$invoice_number);
        $plan_id = $invoice[0]->plan_id;
        $user_id = $invoice[0]->user_id;
        $plan = DB::select("SELECT * FROM plan where id = ".$plan_id);
        $type = $plan[0]->type;
        if($type == 'month'){
            $end_date = date('Y-m-d H:i:s',strtotime($date.' + 1 month'));
        } else 
        if($type == 'year'){
            $end_date = date('Y-m-d H:i:s',strtotime($date.' + 1 years'));
        } 
        DB::update(
            'update user_plan set end_at = "'.$date.'" where end_at > "'.$date.'" and user_id = ?',
            [$user_id]
        );
        DB::table('user_plan')->insert([
            'plan_id' => 'active',
            'user_id' =>$token,
            'start_at' => $date,
            'end_at' =>$end_date,
            'created_at' =>$date,
            'updated_at' => $date
        ]);
    }
    // update all transaction failed
    public function updateFailedPayment($invoice_number){
        //update transaction
        DB::update(
            'update payment_transaction set status = "failed" where invoice_id = ?',
            [$invoice_number]
        );
        // update invoice status
        DB::update(
            'update invoice set status = "failed" where id = ?',
            [$invoice_number]
        );
    }
    // payment paypal success action
    public function paymentPaypalSuccess(Request $request){
        $response = $this->provider->getExpressCheckoutDetails($request->token);
        $cart = [];
        $cart['items'] = [
            [
                'name' => 'PT Bee Mata Indonesia',
                'price' => $response["PAYMENTREQUEST_0_AMT"],
                'desc'  => $response["PAYMENTREQUEST_0_DESC"],
                'qty' => $response["L_PAYMENTREQUEST_0_QTY0"]
            ]
        ];
        $cart['invoice_id'] = $response["PAYMENTREQUEST_0_INVNUM"];
        $cart['invoice_description'] = $response["PAYMENTREQUEST_0_DESC"];
        $cart['return_url'] = route('payment.success');
        $cart['cancel_url'] = route('payment.cancel');
        $cart['total'] = $response["PAYMENTREQUEST_0_AMT"];
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
        $invoice_number = $response["PAYMENTREQUEST_0_INVNUM"];
        $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

        if ($status == 'Completed' || $status == 'Processed') {

            $this->updateSuccessPayment($invoice_number);
            
            return redirect()->route('single');
        } else {
            $this->updateFailedPayment($invoice_number);
            return redirect()->route('plan');
        } 
        
    }
    // payment paypal cancel action
    public function paymentPaypalCancel(Request $request){
        $response = $this->provider->getExpressCheckoutDetails($request->token);
        $invoice_id = $response["PAYMENTREQUEST_0_INVNUM"];
        $this->updateFailedPayment($invoice_id);
        // get data from paypal
        return redirect()->route('plan');
    }
    public function paymentMidtransCallbackStatus(Request $request){

        $status = $request->transaction_status;
        $invoice_number = $request->order_id;
        if($status == 'settlement' || $status == 'capture'){
            $next_step = true;
        } else 
        if($status == 'deny' || $status == 'expire' || $status == 'cancel'){
            $next_step = false;
        }
        if($next_step == true){
            $this->updateSuccessPayment($invoice_number);
        } else {
            $this->updateFailedPayment($invoice_number);
        }
        return Response::json($request, 200);
    }
}
