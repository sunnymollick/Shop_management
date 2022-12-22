<?php

namespace App\Http\Controllers;

use App\Account;
use App\Bundle;
use App\Customer;
use App\Invoice;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\Receipt;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use League\CommonMark\Extension\Table\Table;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::where('is_deleted', 0)
                            ->where('stock', '>', 0)
                            ->latest()->get();
        $customers = Customer::where('is_deleted', 0)->get();
        $bundles = Bundle::where('is_deleted', 0)->get();
        return view('pos.index', ['products' => $products, 'customers' => $customers, 'bundles' => $bundles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->all());
        // return $request;
        // $customerId = 1;
        // $customerName = 'Walk-in Customer';
        $show_receipt = false;

        // Create new customer

        if (isset($request->customerName)) {
            $customer = new Customer();
            $customer->name = $request->customerName;

            if (isset($request->mobile)) {
                $customer->mobile = $request->mobile;
            }
            if ($request->hasFile('image')) {
                $image           = $request->file('image');
                $name            = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/customer_image');
                $file_path       = 'customer_image/'.$name;
                $image->move($destinationPath, $name);
                $customer->image = $file_path;
            }
            if (isset($request->address)) {
                $customer->address = $request->address;
            }
            if (isset($request->nid)) {
                $customer->nid = $request->nid;
            }
            if (isset($request->passport)) {
                $customer->passport = $request->passport;
            }
            if (isset($request->comment)) {
                $customer->comment = $request->comment;
            }
            $customer->save();
            $customerId   = $customer->id;
            $customerName = $request->customerName;
        }else if(isset($request->customerId)){
            $customerInfo = explode(",", $request->customerId);
            $customerId = $customerInfo[0];
            $customerName = $customerInfo[1];
        }else{
            $customerId = Auth::user()->id;
            $customerName = Auth::user()->name;
        }

        $discount = 0;
        if (isset($request->discount)) {
            $discount = $request->discount;
        }
        $paid_amount = 0;
        if (isset($request->paid)) {
            $paid_amount = $request->paid;
            $show_receipt = true;
        }

        // New start date
        $a = date_create_from_format("m/d/Y",$request->startDate);
        // dd($a);
        $startDate = $a->format('Y-m-d');

        // $b = date_create_from_format("m/d/Y",$request->returnDate);
        // // dd($b);
        // $returnDate = $b->format('Y-m-d');

        // create order
        $order = new Order();
        $order->customer_id     = $customerId;
        $order->start_date     = $startDate;
        // $order->return_date     = $returnDate;
        $order->order_value     = $request->totalAmount;
        $order->discount_amount = $discount;
        $order->amount_paid     = $paid_amount;
        $order->advance_paid     = $paid_amount;
        $order->total_quantity  = 0;
        $order->status_code = mt_rand(100000,999999);



        if (($paid_amount + $discount) == $request->totalAmount) {
            $order->is_paid = true;
        } else {
            $order->is_paid = false;
        }
        $order->save();
        $orderId = $order->id;

        $details = [
            'title' => 'Mail for order confirmation',
            'body' => 'your order tracking code is '.$order->status_code,
        ];


        $customer  = DB::Table('customers')->where('id',$customerId)->first();

        Mail::to($customer->email)->send(new \App\Mail\SendOrderTrackingCode($details));


        $total_quantity = 0;
        // Create Order-Products
        if (isset($request->productId)) {
            foreach ($request->productId as $idx => $pid ) {
                $all_array[] = [ $pid, $request->subTotal[$idx], $request->quantity[$idx] ];
                $op = new OrderProduct();
                $op->order_id = $orderId;
                $op->product_id = $pid;
                $op->quantity = $request->quantity[$idx];
                $op->price = $request->subTotal[$idx];
                $op->save();

                $p = Product::findOrFail($pid);
                $prev_stock = $p->stock;
                // $prev_in_service = $p->is_in_service;
                $p->stock = $prev_stock - $request->quantity[$idx];
                // $p->is_in_service = $prev_in_service + $request->quantity[$idx];

                $p->save();

                $total_quantity += $request->quantity[$idx];
                // dd($total_quantity, $request->quantity[$idx]);
            }
            $order = Order::findOrFail($orderId);
            $order->total_quantity = $total_quantity;
            $order->save();

        }

        // create invoice
        $settings = Setting::findOrFail(1);
        $customerInvoices = Invoice::where('customer_id', $customerId)->get();
        $presence = $customerInvoices->count();
        $newNum = (int)$presence + 1;
        $invoice = new Invoice();
        $invoice->invoice_id = $settings->invoice_prefix.$customerId.$newNum;
        $invoice->order_id = $orderId;
        $invoice->issue_date = date('Y-m-d');

        // dd($a, $a->format('Y-m-d'));
        // $invoice->due_date = $returnDate;
        $invoice->save();
        // Create receipt
        if ($paid_amount > 0) {
            $receipt = new Receipt();
            $receipt->order_id = $orderId;
            $receipt->payment_amount = $paid_amount;
            $receipt->discount = $discount;
            $receipt->save();

            // Update acc
            $account = new Account();
            $account->amount        = $paid_amount;
            $account->account_type  = $request->payment_method;
            $account->order_id  = $orderId;
            $account->customer_id   = $customerId;
            $account->customer_name = $customerName;
            if (($paid_amount + $discount) == $request->totalAmount) {
                $account->category      = 'Final Payment';
            }else{
                $account->category      = 'Advance Payment';
            }

            if ($request->transaction_code) {
                $account->transaction_code = $request->transaction_code;
            }else{
                $account->transaction_code = 'Cash';
            }

            if ($request->ref) {
                $account->reference     = $request->ref;
            }else{
                $account->reference     = 'Self';
            }

            // $account->description   = $customer_name;
            $account->save();

        }


        // return back();
        // return redirect()->route('orders.show', $orderId);
        // return to OrderViewById -> This will contain buttons for invoice and receipt



        // if receipt
            // return with invoiceId, receiptId to printBothButton
        // else
            // return with invoiceId to printInvoiceButton
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
