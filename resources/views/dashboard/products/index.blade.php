@extends('dashboard.layout.app', ['title' => 'Products'])

@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products Table</h3>

                    <div class="card-tools">
                        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i>
                            Add New Product
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        @if ($product->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" width="70" height="70"
                                            alt="product">
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount_price ?? '-' }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->brand ? $product->brand->name : '-' }}</td>
                                    <td>
                                        {{ $product->created_at->toDateString() }}
                                    </td>
                                    <td class="gap-2 d-flex">
                                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-light">Edit</a>

                                        <form class="mx-2"
                                            action="{{ route('dashboard.products.destroy', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                        </form>
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
