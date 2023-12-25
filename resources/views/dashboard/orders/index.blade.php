@extends('dashboard.layout.app', ['title' => $status . ' Orders'])

@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">
        {{ $status }} Orders
    </li>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $status }} Orders Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Delievery Status</th>
                                <th>Payment Method</th>
                                <th>#Products</th>
                                <th>Total</th>
                                <th>Ordered At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 'accepted')
                                            <span class="badge badge-info">Accepted</span>
                                        @elseif($order->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->payment_status == 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @else
                                            <span class="badge badge-danger">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->delivery_status == 'delivered')
                                            <span class="badge badge-success">Delievered</span>
                                        @else
                                            <span class="badge badge-danger">Undelievered</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>
                                        {{ $order->products_count }}
                                    </td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        {{ $order->created_at->toDateString() }}
                                    </td>
                                    <td class="gap-2 d-flex">
                                        <a href="{{ route('dashboard.orders.show' , $order->id) }}"
                                            class="btn btn-sm btn-info">Show</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No Products Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
