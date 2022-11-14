@extends('layouts.app2')

@section('content')

<section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-lg-2 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                <h4>{{$total_products}}</h4>

                <p>Total Products</p>
                </div>
                <div class="icon">
                <i class="fa fa-camera"></i>
                </div>
                <a href="{{route('products.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                <h4>{{$total_customers}}</h4>

                <p>Total Customers</p>
                </div>
                <div class="icon">
                <i class="fa fa-users"></i>
                </div>
                <a href="{{route('customers.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                <h4>{{$bill_pending_paid_amount}}Tk</h4>

                <p>Total Payment Paid</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <a href="{{route('customers.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                    <h4>{{$bill_pending_due_amount}}Tk</h4>

                    <p>Total Payment Due</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
                    </div>
                    <a href="{{route('customers.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                    <h4> {{$totalTransaction}} Tk  </h4>

                    <p>Total Transaction</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <a href="{{route('customers.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                        <h4>Total {{$total_orders}}</h4>

                        <p>Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-database" aria-hidden="true"></i>
                        </div>
                        <a href="{{route('customers.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>



                <div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title text-danger">Products Alert</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        {{-- <th>Sr.</th> --}}
                        <th>Title</th>
                        <th>Category</th>
                        {{-- <th>Supplier</th> --}}
                        <th>Stock</th>
                        <th>SKU #</th>
                        {{-- <th>Unit Price</th> --}}
                        <th>Image</th>
                        @if ((Auth::user()->is_admin) == 1 || (Auth::user()->is_admin) == 2 )
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    {{-- @php
                        $cnt = 1;
                    @endphp --}}
                    @foreach ($products as $product)
                        <tr>
                            {{-- <td>{{ $cnt++ }}</td> --}}
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->category ? $product->category->name : "No Category"}}</td>
                            {{-- <td>{{ $product->supplier }}</td> --}}
                            <td> <span class="label bg-red">
                                @if ($product->stock > 0)
                                    {{ $product->stock }}
                                @else
                                    <small class="label bg-red" style="">No Products Available</small>
                                @endif
                            </span>
                            </td>
                            <td>{{ $product->art_no }}</td>
                            {{-- <td>{{ $product->unit_price }}</td> --}}
                            <td>
                                <img src="{{ asset($product->image_path)}}" height="50" , width="50">
                            </td>
                            @if ((Auth::user()->is_admin) == 1 || (Auth::user()->is_admin) == 2 )
                            <td>
                                <span class="">
                                    <a href="{{ route('stocks.add', $product->id) }}">
                                        <small class="label bg-green" style="margin-right: 15px">Add
                                            Stock</small>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                                    </a>
                                    <a onclick="return confirm('Are you sure?')"
                                        href="{{ route('products.delete', $product->id) }}">
                                        <small class="label bg-red" style="margin-right: 15px">Delete</small>
                                    </a>
                                </span>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        {{-- <th>Sr.</th> --}}
                        <th>Title</th>
                        <th>Category</th>
                        {{-- <th>Supplier</th> --}}
                        <th>Stock</th>
                        <th>SKU #</th>
                        {{-- <th>Unit Price</th> --}}
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title text-success">Recent Sale</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Product</th>
                        <th>Customer</th>
                        {{-- <th>Supplier</th> --}}
                        {{-- <th>Stock</th>
                        <th>SKU #</th> --}}
                        {{-- <th>Unit Price</th> --}}
                        {{-- <th>Image</th>
                        @if ((Auth::user()->is_admin) == 1 || (Auth::user()->is_admin) == 2 )
                        <th>Action</th>
                        @endif --}}
                    </tr>
                </thead>
                <tbody>

                    @php
                        $cnt = 1
                    @endphp
                    @foreach ($order_product as $row)
                        <tr>
                            <td>{{ $cnt++ }}</td>
                            <td>{{ $row->product }}</td>
                            <td>
                                @php
                                    $customer = DB::table('orders')->join('customers','orders.customer_id','customers.id')
                                                                    ->select('customers.name as customer')
                                                                    ->where('customers.id',$row->order)
                                                                    ->first();
                                @endphp
                                {{ $customer->customer }}
                            </td>
                            {{-- <td>{{ $product->category ? $product->category->name : "No Category"}}</td> --}}
                            {{-- <td>{{ $product->supplier }}</td> --}}
                            {{-- <td> <span class="label bg-red">
                                @if ($product->stock > 0)
                                    {{ $product->stock }}
                                @else
                                    <small class="label bg-red" style="">In Service</small>
                                @endif
                            </span>
                            </td> --}}
                            {{-- <td>{{ $product->art_no }}</td> --}}
                            {{-- <td>{{ $product->unit_price }}</td> --}}
                            {{-- <td>
                                <img src="{{ asset($product->image_path)}}" height="50" , width="50">
                            </td> --}}
                            {{-- @if ((Auth::user()->is_admin) == 1 || (Auth::user()->is_admin) == 2 )
                            <td>
                                <span class="">
                                    <a href="{{ route('stocks.add', $product->id) }}">
                                        <small class="label bg-green" style="margin-right: 15px">Add
                                            Stock</small>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                                    </a>
                                    <a onclick="return confirm('Are you sure?')"
                                        href="{{ route('products.delete', $product->id) }}">
                                        <small class="label bg-red" style="margin-right: 15px">Delete</small>
                                    </a>
                                </span>
                            </td>
                            @endif --}}
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr.</th>
                        <th>Product</th>
                        {{-- <th>Category</th> --}}
                        {{-- <th>Supplier</th> --}}
                        {{-- <th>Stock</th>
                        <th>SKU #</th> --}}
                        {{-- <th>Unit Price</th> --}}
                        {{-- <th>Image</th>
                        <th>Action</th> --}}
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
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
    <script>
        $(function() {
            $('#example2').DataTable({
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
