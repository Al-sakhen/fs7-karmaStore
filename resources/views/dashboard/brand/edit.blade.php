@extends('dashboard.layout.app', ['title' => 'Edit Brand'])

@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Brand</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dashboard.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        {{-- name field --}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $brand->name }}" name="name" class="form-control" id="name"
                                placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            {{-- // 0 or 1 --}}
                            <label for="status">Status</label>
                            <select name="status" class="custom-select" id="status">
                                <option value="1" @selected($brand->status == 1)>active</option>
                                <option value="0" @selected($brand->status == 0)>inactive</option>
                            </select>
                        </div>

                        <div>
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                        </div>

                        <img src="{{ asset('storage/'.$brand->image) }}" alt="">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection


@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection
