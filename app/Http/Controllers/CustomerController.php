<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $customers = Customer::where('is_deleted', 0)->get();
        return view('customer.index', ['customers' => $customers]);
    }

    public function customerOrders($id){
        // $orders = Order::where('customer_id',$id)->where('is_deleted',0)->get();
        $orders = DB::table('orders')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address')
                    ->where('orders.customer_id',$id)
                    ->where('orders.is_deleted', '=', 0)
                    ->orderBy('id', 'DESC')
                    ->latest()
                    ->get();

        // $orders_value = DB::table('orders')
        //             ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
        //             ->select('orders.*', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address')
        //             ->where('orders.customer_id',$id)
        //             ->where('orders.is_deleted', '=', 0)
        //             ->orderBy('id', 'DESC')
        //             ->latest()
        //             ->sum('order_value','discount_amount');

        $orders_value = $orders->sum('order_value');
        $amount_paid = $orders->sum('amount_paid');
        $discount_value = $orders->sum('discount_amount');



        return view('customer.customer_order',['orders'=>$orders,'orders_value'=>$orders_value,'amount_paid'=>$amount_paid,'discount_value'=>$discount_value]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;

        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $name            = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/customer_image');
            $file_path       = 'customer_image/'.$name;
            $image->move($destinationPath, $name);
        }

        $customer->delivery_address = $request->deliveryAddress;
        $customer->nid = $request->nid;
        $customer->passport = $request->passport;
        $customer->comment = $request->comment;

        if ($file_path) {
            $customer->image  = $file_path;
        }

        if ($customer->save()) {
            Session::flash('customer_add_message', 'Customer Added Successfully!');
        } else {
            Session::flash('customer_add_message', 'Customer Adding Failed!');
            Session::flash('alert-class', 'alert-danger');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $customer = Customer::findOrFail($id);

        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $name            = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/customer_image');
            $file_path       = 'customer_image/'.$name;
            $image->move($destinationPath, $name);
            unlink($customer->image);

            $customer->image  = $file_path;


            // if (isset($file_path)) {
            //     $product->image_path  = $file_path;

            // } else {
            //     $product->image_path  = 'uploads/default.png';
            // }
        }

        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->delivery_address = $request->deliveryAddress;
        $customer->nid = $request->nid;
        $customer->passport = $request->passport;
        $customer->comment = $request->comment;


        if ($customer->save()) {
            Session::flash('customer_update_message', 'Customer Update Successfully!');
        } else {
            Session::flash('customer_update_message', 'Customer Updating Failed!');
            Session::flash('alert-class', 'alert-danger');
        }
        return back();
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

    public function delete($id) {
        $customer = Customer::findOrFail($id);
        $customer->is_deleted = 1;
        unlink($customer->image);
        $customers = Customer::where('is_deleted', 0)->latest()->get();

        if ($customer->id == 1) {
            Session::flash('customer_delete_message', 'Walk-in customer can not be deleted!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('customers.index', ['customers' => $customers]);
        }
        if ($customer->delete()) {
            Session::flash('customer_delete_message', 'Customer Deleted Successfully!');
        } else {
            Session::flash('customer_delete_message', 'Customer Deleted Failed!');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->route('customers.index', ['customers' => $customers]);
    }

    public function login(){
        return view('customer.login.login');
    }
}
