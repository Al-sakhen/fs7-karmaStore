@extends('dashboard.layout.app', ['title' => 'Brands'])

@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">brands</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            {{-- @if (session()->has('success'))
                <div class="alert alert-success">
                    <h5><i class="icon fas fa-check"></i> Success</h5>
                    {{ session()->get('success') }}
                </div>
            @endif --}}

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Brands Table</h3>

                    <div class="card-tools">
                        <a href="{{ route('dashboard.brands.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i>
                            Add New Brand
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @if ($brand->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/'.$brand->image) }}" width="70" height="70" alt="brand">
                                    </td>
                                    <td>
                                        {{ $brand->created_at->toDateString() }}
                                        {{-- {{ $brand->created_at->diffForHumans() }} --}}
                                    </td>
                                    <td class="gap-2 d-flex">
                                        <a href="{{ route('dashboard.brands.edit', $brand->id) }}"
                                            class="btn btn-sm btn-light">Edit</a>

                                        <form class="mx-2" action="{{ route('dashboard.brands.destroy', $brand->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Brands Found</td>
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
