@extends('dashboard.layout.app', ['title' => 'Show Invoice'])

@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">
        Show Invoice
    </li>
@endsection


@section('content')
    <div class="p-3 mb-3 invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Karma Store.
                    <small class="float-right">Date: {{ $order->created_at->toDateString() }}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">

            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>
                        {{ $order->name }}
                    </strong><br>
                    {{ $order->email }}<br>
                    {{ $order->phone }}<br>
                    {{ $order->city }}<br>
                    {{ $order->address }}<br>
                    {{ $order->postal_code }}<br>

                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #{{ $order->id }}</b><br>
                <br>
                {{ $order->more_info ?? '' }}<br>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <strong>Status</strong>
                @if ($order->status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($order->status == 'accepted')
                    <span class="badge badge-info">Accepted</span>
                @elseif($order->status == 'rejected')
                    <span class="badge badge-danger">Rejected</span>
                @endif
                <br>
                <strong>Delievery Status</strong>
                @if ($order->delivery_status == 'delivered')
                    <span class="badge badge-success">Delivered</span>
                @else
                    <span class="badge badge-danger">Undelievered</span>
                @endif
                <br>
                <strong>Payment Staus</strong>
                @if ($order->payment_status == 'paid')
                    <span class="badge badge-success">Paid</span>
                @else
                    <span class="badge badge-danger">Unpaid</span>
                @endif
                <br>
                <hr>
                <hr>
                @if ($order->status == 'pending')
                    <h5 class="text-center">
                        Status actions
                    </h5>
                    <a href="{{ route('dashboard.orders.status', ['order' => $order->id, 'status' => 'accepted']) }}"
                        class="btn btn-info btn-block">Accept</a>
                    <a href="{{ route('dashboard.orders.status', ['order' => $order->id, 'status' => 'rejected']) }}"
                        class="btn btn-danger btn-block">Reject</a>
                @endif

                @if ($order->payment_status == 'unpaid' && $order->status == 'accepted' && $order->delivery_status == 'undelivered')
                    <h5 class="text-center">
                        Delivery actions
                    </h5>
                    <a href="{{ route('dashboard.orders.delivery_status', ['order' => $order->id, 'status' => 'delivered']) }}"
                        class="btn btn-success btn-block">Delivered</a>
                @endif


                @if ($order->payment_status == 'paid' && $order->status == 'accepted' && $order->delivery_status == 'undelivered')
                    <h5 class="text-center">
                        Delivery actions
                    </h5>
                    <a href="{{ route('dashboard.orders.delivery_status', ['order' => $order->id, 'status' => 'delivered']) }}"
                        class="btn btn-success btn-block">Delivered</a>
                @endif


                @if ($order->payment_status == 'unpaid' && $order->status == 'accepted' && $order->delivery_status == 'delivered')
                    <h5 class="text-center">
                        Payment actions
                    </h5>
                    <a href="{{ route('dashboard.orders.payment_status', ['order' => $order->id, 'status' => 'paid']) }}"
                        class="btn btn-success btn-block">Paid</a>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt=""
                                        height="70">
                                    {{ $item->product->title }}
                                </td>
                                <td>
                                    ${{ $item->unit_price }}
                                </td>
                                <td>
                                    ${{ $item->total }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- /.col -->
            <div class="col-6">
                <p class="lead">Amount Due {{ $order->created_at->toDateString() }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>${{ $order->total }}</td>
                        </tr>

                        <tr>
                            <th>Total:</th>
                            <td>${{ $order->total }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
