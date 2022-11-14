@extends('layouts.app2')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if (Session::has('order_delete_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('order_delete_message') }}</p>
                    {{ Session::forget('order_delete_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Orders</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>Customer</th>
                                    <th>Total Devices</th>
                                    <th>Order Value</th>
                                    <th>Discount</th>
                                    <th>Paid Amount.</th>
                                    <th>Payment Status</th>
                                    <th>Due</th>
                                    {{-- <th>Created At</th> --}}
                                    <th>Order Date</th>
                                    {{-- <th>Return Date</th> --}}
                                    {{-- <th>Return</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = 1; ?>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->cname }} - {{ $order->mobile }}</td>
                                        <td>{{ $order->total_quantity }}</td>
                                        <td>{{ $order->order_value }}</td>
                                        <td>{{ $order->discount_amount }}</td>
                                        <td>{{ $order->amount_paid }}</td>
                                        <td>
                                            @if ( ( $order->order_value - ($order->amount_paid + $order->discount_amount)) == 0)
                                                <span class="label label-success">Paid</span>
                                            @else
                                                <span class="label label-danger">Due</span>
                                            @endif
                                        </td>
                                        <td>{{

                                                $order->order_value - ($order->amount_paid + $order->discount_amount)

                                        }}</td>
                                        {{-- <td>{{ date_format(date_create($order->created_at), 'm/d/Y h:i A') }}</td> --}}
                                        <td>{{ date_format(date_create($order->start_date), 'm/d/Y') }}</td>
                                        {{-- <td>{{ date_format(date_create($order->return_date), 'm/d/Y') }}</td> --}}
                                        {{-- <td>
                                            @if ($order->is_return != 1)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('orders.return', $order->id) }}">
                                                    <small class="label bg-green" style="margin-right: 15px">Return</small>
                                                </a>
                                            @else
                                                Returned
                                            @endif
                                        </td> --}}
                                        <td>
                                            <span class="">
                                                <a href="{{ route('orders.show', $order->id) }}">
                                                    <small class="label bg-green" style="margin-right: 15px">View</small>
                                                </a>
                                                {{-- <a href="{{route('products.edit', $order->id)}}">
                          <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                        </a> --}}
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('orders.delete', $order->id) }}">
                                                    <small class="label bg-red" style="margin-right: 15px">Cancel</small>
                                                </a>

                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID #</th>
                                    <th>Customer</th>
                                    <th>Total Devices</th>
                                    <th>Order Value</th>
                                    <th>Discount</th>
                                    <th>Paid Amount.</th>
                                    <th>Created At</th>
                                    <th>Return Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>


<div class="row">
    <div class="card">
        <div class="card-body">
            <!-- accepted payments column -->
            <div class="col-xs-6">
            </div>
            <!-- /.col -->
            <div class="col-xs-4 offset-md-2">
                <div class="table-responsive ">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width:50%">Total Order Value:</th>
                            <td>৳ {{ $orders_value }}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Total Discount:</th>
                            <td>৳ {{ $discount_value }}</td>
                        </tr>
                        <tr>
                            <th>Advance Payment:</th>
                            <td>৳ {{ $amount_paid }}</td>
                        </tr>
                        <tr>
                            <th>Total Due:</th>
                            <td>৳ {{ $orders_value - ($amount_paid + $discount_value) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
    <!-- /.col -->
        </div>
    </div>

</div>
</div>

    </section>
@endsection

@push('js')
    <script>
        $(function() {
            $('#example1').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[ 0, "desc" ]]
            })
        });

    </script>
@endpush
